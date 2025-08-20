<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\QualityControlDetailModel;
use App\Models\Admin\QualityControlImageModel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class QualityControlDetailImageController extends Controller
{
    public function index(Request $request, $projectDetailId)
    {
        $activeMenu = 'qc.project';
        $search = $request->input('search');

        $projectDetail = QualityControlDetailModel::findOrFail($projectDetailId);
        $detailImage = QualityControlImageModel::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
            })
            ->where('detail_id', $projectDetailId)
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.quality_control.project.project_detail.detail_image.index', compact('projectDetail', 'detailImage', 'activeMenu'));
    }

    public function create($projectDetailId)
    {
        $activeMenu = 'qc.project';
        return view('admin.quality_control.project.project_detail.detail_image.create', compact('projectDetailId', 'activeMenu'));
    }

    public function store(Request $request, $projectDetailId)
    {
        $currentDateTime = now()->format('Ymd-His');

        $projectDetail = QualityControlDetailModel::findOrFail($projectDetailId);

        $request->validate([
            'name' => 'required|string|max:50',
            'img.*' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',
        ]);

        if ($request->hasFile('img')) {
            $images = $request->file('img');
            foreach ($images as $index => $imgFile) {
                $fileIndex = $index + 1;
                $imgFileName = $projectDetail->project_id . '-' . $projectDetailId . '-' . $currentDateTime . '-' . $fileIndex . '.' . $imgFile->getClientOriginalExtension();

                $image = Image::make($imgFile)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $fileSizeInKB = $imgFile->getSize() / 1024;

                if ($fileSizeInKB > 800) {
                    // Compress jika ukuran file > 300KB
                    $image->save(storage_path("app/public/uploads/quality_control_detail/{$imgFileName}"), 90);
                } else {
                    $image->save(storage_path("app/public/uploads/quality_control_detail/{$imgFileName}"));
                }

                QualityControlImageModel::create([
                    'project_id' => $projectDetail->project_id,
                    'detail_id' => $projectDetailId,
                    'name' => $request->name . " - {$fileIndex}",
                    'img' => $imgFileName,
                ]);
            }
        }

        return redirect()->route('admin.qc.project.project_detail_image.index', $projectDetailId)
                         ->with('success', 'Project detail image created successfully.');
    }

    public function edit($projectDetailId, $id)
    {
        $detailImage = QualityControlImageModel::findOrFail($id);

        $activeMenu = 'qc.project';
        return view('admin.quality_control.project.project_detail.detail_image.edit', compact('projectDetailId', 'detailImage', 'activeMenu'));
    }

    public function update(Request $request, $projectDetailId, $id)
    {
        $currentDateTime = now()->format('Ymd-His');
        $projectDetail = QualityControlDetailModel::findOrFail($projectDetailId);
        $detailImage = QualityControlImageModel::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:50',
            'img' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',
        ]);

        $imgFileName = $detailImage->img;

        if ($request->hasFile('img')) {
            $filePath = 'uploads/quality_control_detail/' . $detailImage->img;
            if ($detailImage->img && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $imgFile = $request->file('img');
            $fileSizeInKB = $imgFile->getSize() / 1024;

            $image = Image::make($imgFile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imgFileName = $projectDetail->project_id . '-' . $projectDetailId . '-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            if ($fileSizeInKB > 800) {
                $image->save(storage_path("app/public/uploads/quality_control_detail/{$imgFileName}"), 90);
            } else {
                $image->save(storage_path("app/public/uploads/quality_control_detail/{$imgFileName}"));
            }
        }

        $detailImage->update([
            'name' => $request->name,
            'img' => $imgFileName,
        ]);

        return redirect()->route('admin.qc.project.project_detail_image.index', $projectDetailId)
                         ->with('success', 'Project detail image updated successfully.');
    }

    public function destroy($projectDetailId, $id)
    {
        $detailImage = QualityControlImageModel::findOrFail($id);

        $filePath = 'uploads/quality_control_detail/' . $detailImage->img;

        if ($detailImage->img && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $detailImage->delete();

        return redirect()->route('admin.qc.project.project_detail_image.index', $projectDetailId)
                         ->with('success', 'Project detail image deleted successfully.');
    }
}
