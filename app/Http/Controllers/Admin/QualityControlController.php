<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\CategoryProjectModel;
use App\Models\Admin\QualityControlModel;
use App\Models\Admin\QualityControlDetailModel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class QualityControlController extends Controller
{
    public function index(Request $request)
    {
        $activeMenu = 'qc.project';

        $search = $request->input('search');

        $project = QualityControlModel::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('client', 'like', '%' . $search . '%')
                ->orWhere('product', 'like', '%' . $search . '%');
            })
            ->with('category')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.quality_control.project.index', compact('activeMenu','project', 'search'));
    }

    public function create()
    {
        $activeMenu = 'qc.project';
        $category = CategoryProjectModel::all();
        return view('admin.quality_control.project.create', compact('activeMenu','category'));
    }

    public function store(Request $request)
    {
        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'name' => 'required|string|max:125',
            'project_date' => 'required|date',
            'client' => 'required|string|max:255',
            'product' => 'nullable|string|max:255',
            'project_info' => 'required|string',
            'image' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',
            'password' => 'required|string|max:100',
            'publish' => 'required',
            'category_id' => 'required|exists:category_project,id',
        ]);

        $permalink = str_replace(' ', '-', $request->name);
        $imgFileName = null;

        if ($request->hasFile('image')) {
            $imgFile = $request->file('image');

            $fileSize = $imgFile->getSize();
            $fileSizeInKB = $fileSize / 1024;

            $image = Image::make($imgFile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imgFileName = 'QC-' . strtoupper($permalink) . '-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            if ($fileSizeInKB > 300) {
                $image->save(storage_path("app/public/uploads/quality_control/{$imgFileName}"), 85);
            } else {
                $image->save(storage_path("app/public/uploads/quality_control/{$imgFileName}"));
            }
        }

        $project = QualityControlModel::create([
            'name' => $request->name,
            'project_date' => $request->project_date,
            'client' => $request->client,
            'product' => $request->product,
            'project_info' => $request->project_info,
            'image' => $imgFileName,
            'password' => $request->password,
            'password_access' => Hash::make($request->password),
            'permalink' => $permalink,
            'publish' => $request->publish,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.qc.project.index')
                        ->with('success', 'Quality control created successfully!');
    }


    public function edit($id)
    {
        $activeMenu = 'qc.project';
        $category = CategoryProjectModel::all();
        $project = QualityControlModel::findOrFail($id);
        return view('admin.quality_control.project.edit', compact('activeMenu', 'category', 'project'));
    }

    public function update(Request $request, $id)
    {
        $project = QualityControlModel::findOrFail($id);

        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'name' => 'required|string|max:125',
            'project_date' => 'required|date',
            'client' => 'required|string|max:255',
            'product' => 'nullable|string|max:255',
            'project_info' => 'required|string',
            'image' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',
            'password' => 'required|string|max:100',
            'publish' => 'required|boolean',
            'category_id' => 'required|exists:category_project,id',
        ]);

        $permalink = str_replace(' ', '-', $request->name);

        if ($request->hasFile('image')) {
            $imgFile = $request->file('image');

            $fileSize = $imgFile->getSize();
            $fileSizeInKB = $fileSize / 1024;

            $image = Image::make($imgFile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imgFileName = 'QC-' . strtoupper($permalink) . '-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            if ($fileSizeInKB > 300) {
                $image->save(storage_path("app/public/uploads/quality_control/{$imgFileName}"), 85);
            } else {
                $image->save(storage_path("app/public/uploads/quality_control/{$imgFileName}"));
            }

            if ($project->image) {
                Storage::delete("public/uploads/quality_control/{$project->image}");
            }

            $project->image = $imgFileName;
        }

        $project->name = $request->name;
        $project->project_date = $request->project_date;
        $project->client = $request->client;
        $project->product = $request->product;
        $project->project_info = $request->project_info;
        $project->password = $request->password;
        $project->password_access = Hash::make($request->password);
        $project->permalink = $permalink;
        $project->publish = $request->publish;
        $project->category_id = $request->category_id;

        $project->save();

        return redirect()->route('admin.qc.project.index')
                         ->with('success', 'Quality control updated successfully!');
    }

    public function update_publish(Request $request, $id)
    {
        $request->validate([
            'publish' => 'required|boolean',
        ]);

        $project = QualityControlModel::findOrFail($id);

        if (!$project) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $project->publish = $request->publish ? 1 : 0;
        $project->save();

        return response()->json(['message' => 'Publish status updated successfully.']);
    }

    public function destroy($id)
    {
        $project = QualityControlModel::findOrFail($id);
        $hasDetails = QualityControlDetailModel::where('project_id', $id)->exists();

        if ($hasDetails) {
            return redirect()->route('admin.qc.project.index')
                             ->with('error', 'There are data in the project detail. Please delete the project details first.');
        }

        $filePath = 'uploads/quality_control/' . $project->image;

        if ($project->image && Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        $project->delete();

        return redirect()->route('admin.qc.project.index')
                         ->with('success', 'Quality control deleted successfully.');
    }
}


