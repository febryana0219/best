<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AboutModel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutModel::all();
        $activeMenu = 'static_page.about';
        return view('admin.manage_static_page.about.index', compact('about', 'activeMenu'));
    }

    public function edit($id)
    {
        $about = AboutModel::findOrFail($id);

        $activeMenu = 'static_page.about';
        return view('admin.manage_static_page.about.edit', compact('about', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $about = AboutModel::findOrFail($id);

        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img1' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif', // Max 10MB
            'img2' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',  // Max 10MB
        ]);

        if ($request->hasFile('img1')) {
            $img1File = $request->file('img1');

            $fileSize = $img1File->getSize();
            $fileSizeInKB = $fileSize / 1024;

            $Image1 = Image::make($img1File)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img1FileName = 'About1-' . $currentDateTime . '.' . $img1File->getClientOriginalExtension();

            if ($fileSizeInKB > 800) {
                $Image1->save(storage_path("app/public/uploads/about/{$img1FileName}"), 90);
            } else {
                $Image1->save(storage_path("app/public/uploads/about/{$img1FileName}"));
            }

            if ($about->img1) {
                Storage::delete("public/uploads/about/{$about->img1}");
            }

            $about->img1 = $img1FileName;
        }

        if ($request->hasFile('img2')) {
            $img2File = $request->file('img2');

            $fileSize = $img2File->getSize();
            $fileSizeInKB = $fileSize / 1024;

            $Image2 = Image::make($img2File)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img2FileName = 'About2-' . $currentDateTime . '.' . $img2File->getClientOriginalExtension();

            if ($fileSizeInKB > 800) {
                $Image2->save(storage_path("app/public/uploads/about/{$img2FileName}"), 90);
            } else {
                $Image2->save(storage_path("app/public/uploads/about/{$img2FileName}"));
            }

            if ($about->img2) {
                Storage::delete("public/uploads/about/{$about->img2}");
            }

            $about->img2 = $img2FileName;
        }

        $about->title = $request->title;
        $about->description = $request->description;

        $about->save();

        return redirect()->route('admin.static_page.about.index')
                         ->with('success', 'About updated successfully.');
    }
}
