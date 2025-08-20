<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\QualityControlModel;
use App\Models\Admin\ProjectImageModel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProjectImageController extends Controller
{
    public function index(Request $request, $projectId)
    {
        $activeMenu = 'qc.project';
        $search = $request->input('search');

        $project = QualityControlModel::findOrFail($projectId);
        $detailImage = ProjectImageModel::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
            })
            ->where('project_id', $projectId)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.quality_control.project.project_image.index', compact('project', 'detailImage', 'activeMenu', 'search'));
    }

    public function create($projectId)
    {
        $activeMenu = 'qc.project';
        return view('admin.quality_control.project.project_image.create', compact('projectId', 'activeMenu'));
    }

    public function store(Request $request, $projectId)
    {
        $currentDateTime = now()->format('Ymd-His');
        $project = QualityControlModel::findOrFail($projectId);

        // Maksimal upload 8 gambar
        $existingImagesCount = ProjectImageModel::where('project_id', $projectId)->count();
        if ($existingImagesCount >= 8) {
            return redirect()->route('admin.qc.project.detail_image.index', $projectId)
                            ->with('error', 'You can only upload up to 8 images for this project.');
        }

        $request->validate([
            'name' => 'required|string|max:50',
            'img.*' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',
        ]);

        // Pastikan ada gambar yang diupload
        if (!$request->hasFile('img')) {
            return redirect()->back()->with('error', 'Please upload at least one image.');
        }

        $images = $request->file('img');
        $totalImages = count($images);
        $availableSlots = 8 - $existingImagesCount;

        if ($totalImages > $availableSlots) {
            return redirect()->route('admin.qc.project.detail_image.index', $projectId)
                            ->with('error', "You can only upload {$availableSlots} more images for this project.");
        }

        foreach ($images as $index => $imgFile) {
            $loopIndex = $index + 1;
            $fileSizeInKB = $imgFile->getSize() / 1024;

            $image = Image::make($imgFile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imgFileName = $project->id . '-' . $currentDateTime . "-{$loopIndex}." . $imgFile->getClientOriginalExtension();

            if ($fileSizeInKB > 300) {
                $image->save(storage_path("app/public/uploads/project_image/{$imgFileName}"), 90);
            } else {
                $image->save(storage_path("app/public/uploads/project_image/{$imgFileName}"));
            }

            ProjectImageModel::create([
                'project_id' => $projectId,
                'name' => "{$request->name} - {$loopIndex}",
                'img' => $imgFileName,
            ]);
        }

        return redirect()->route('admin.qc.project.detail_image.index', $projectId)
                        ->with('success', 'Detail images created successfully.');
    }


    public function edit($projectId, $id)
    {
        $activeMenu = 'qc.project';
        $detailImage = ProjectImageModel::findOrFail($id);

        return view('admin.quality_control.project.project_image.edit', compact('projectId', 'detailImage', 'activeMenu'));
    }

    public function update(Request $request, $projectId, $id)
    {
        $currentDateTime = now()->format('Ymd-His');
        $project = QualityControlModel::findOrFail($projectId);
        $detailImage = ProjectImageModel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50',
            'img' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',
        ]);

        $imgFileName = $detailImage->img;

        if ($request->hasFile('img')) {
            $filePath = 'uploads/project_image/' . $detailImage->img;
            if ($detailImage->img && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $imgFile = $request->file('img');
            $fileSizeInKB = $imgFile->getSize() / 1024;

            $image = Image::make($imgFile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imgFileName = $project->id . '-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            if ($fileSizeInKB > 300) {
                $image->save(storage_path("app/public/uploads/project_image/{$imgFileName}"), 90);
            } else {
                $image->save(storage_path("app/public/uploads/project_image/{$imgFileName}"));
            }
        }

        $detailImage->update([
            'name' => $request->name,
            'img' => $imgFileName,
        ]);

        return redirect()->route('admin.qc.project.detail_image.index', $projectId)
                         ->with('success', 'Detail image updated successfully.');
    }

    public function destroy($projectId, $id)
    {
        $detailImage = ProjectImageModel::findOrFail($id);

        $filePath = 'uploads/project_image/' . $detailImage->img;

        if ($detailImage->img && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $detailImage->delete();

        return redirect()->route('admin.qc.project.detail_image.index', $projectId)
                         ->with('success', 'Detail image deleted successfully.');
    }
}
