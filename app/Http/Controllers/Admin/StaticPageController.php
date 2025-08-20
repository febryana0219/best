<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\PagesModel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StaticPageController extends Controller
{
    public function index()
    {
        $static_page = PagesModel::where('custom_page', 1)->orderBy('ordered_no', 'asc')->get();
        $activeMenu = 'static_page.page_header';
        return view('admin.manage_static_page.page_header.index', compact('static_page', 'activeMenu'));
    }

    public function edit($id)
    {
        $page_header = PagesModel::findOrFail($id);
        $activeMenu = 'static_page.page_header';
        return view('admin.manage_static_page.page_header.edit', compact('page_header', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $currentDateTime = now()->format('Ymd-His');

        $page_header = PagesModel::findOrFail($id);

        $request->validate([
            'img' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif', // Max 10MB
        ]);

        if ($request->hasFile('img')) {
            $imgFile = $request->file('img');

            $fileSize = $imgFile->getSize();
            $fileSizeInKB = $fileSize / 1024;

            $image = Image::make($imgFile)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imgFileName = 'P-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            if ($fileSizeInKB > 350) {
                $image->save(storage_path("app/public/uploads/pages/{$imgFileName}"), 90);
            } else {
                $image->save(storage_path("app/public/uploads/pages/{$imgFileName}"));
            }

            if ($page_header->img) {
                Storage::delete("public/uploads/pages/{$page_header->img}");
            }

            $page_header->img = $imgFileName;
            $page_header->save();
        }

        return redirect()->route('admin.static_page.page_header.index')
                         ->with('success', 'Slide show updated successfully.');
    }

    public function update_show_footer(Request $request, $id)
    {
        $request->validate([
            'show_footer' => 'required|boolean',
        ]);

        $static_page = PagesModel::findOrFail($id);

        if (!$static_page) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $static_page->show_footer = $request->show_footer ? 1 : 0;
        $static_page->save();

        return response()->json(['message' => 'Show footer status updated successfully.']);
    }
}
