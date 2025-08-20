<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\CatalogModel;
use App\Models\Admin\CategoryModel;
use Illuminate\Support\Facades\Storage;

class CatalogController extends Controller
{
    public function index($categoryId)
    {
        $catalogs = CatalogModel::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = CategoryModel::findOrFail($categoryId);
        $activeMenu = 'catalog.category';
        return view('admin.catalogs.category.catalog.index', compact('catalogs', 'category', 'activeMenu'));
    }

    public function create($categoryId)
    {
        $category = CategoryModel::findOrFail($categoryId);
        $activeMenu = 'catalog.category';
        return view('admin.catalogs.category.catalog.create', compact('category', 'activeMenu'));
    }

    public function store(Request $request, $categoryId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|max:10240|mimes:xls,xlsx,doc,docx,pdf', // Max 10MB
        ]);

        $category = CategoryModel::findOrFail($categoryId);

        $formattedName = str_replace(' ', '-', $request->name);
        $fileName = "{$category->name}-{$formattedName}." . $request->file->extension();

        $path = $request->file('file')->storeAs('uploads/catalog', $fileName, 'public');

        CatalogModel::create([
            'name' => $request->name,
            'file' => $fileName,
            'category_id' => $categoryId,
        ]);

        return redirect()->route('admin.catalog.category.catalog.index', $categoryId)
                         ->with('success', 'Catalog created successfully.');
    }

    public function edit($categoryId, $catalogId)
    {
        $catalog = CatalogModel::findOrFail($catalogId);
        $category = CategoryModel::findOrFail($categoryId);
        $activeMenu = 'catalog.category';
        return view('admin.catalogs.category.catalog.edit', compact('catalog', 'category', 'activeMenu'));
    }

    public function update(Request $request, $categoryId, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'file' => 'nullable|file|max:10240|mimes:xls,xlsx,doc,docx,pdf', // Max 10MB
        ]);

        $data = [
            'name' => $request->name,
        ];

        $category = CategoryModel::findOrFail($categoryId);
        $catalog = CatalogModel::findOrFail($id);

        // Jika ada file baru yang diupload
        if ($request->hasFile('file')) {
            if ($catalog->file) {
                $oldFilePath = 'uploads/catalog/' . $catalog->file;
                Storage::disk('public')->delete($oldFilePath);
            }

            $formattedName = str_replace(' ', '-', $request->name);
            $fileName = "{$category->name}-{$formattedName}." . $request->file('file')->extension();

            $filePath = $request->file('file')->storeAs('uploads/catalog', $fileName, 'public'); // Simpan file baru
            $data['file'] = $fileName;
        }

        $catalog->update($data);

        return redirect()->route('admin.catalog.category.catalog.index', $categoryId)
                         ->with('success', 'Catalog updated successfully.');
    }


    public function destroy($categoryId, $id)
    {
        $catalog = CatalogModel::findorfail($id);
        $filePath = 'uploads/catalog/' . $catalog->file;

        Storage::disk('public')->delete($filePath);

        $catalog->delete();

        return redirect()->route('admin.catalog.category.catalog.index', $categoryId)
                         ->with('success', 'Catalog deleted successfully.');
    }
}
