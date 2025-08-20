<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProductModel;
use App\Models\Admin\ProductProjectModel;

class ProductProjectController extends Controller
{
    public function index($productId)
    {
        $product = ProductModel::findOrFail($productId);
        $project = ProductProjectModel::where('product_id', $productId)->orderBy('created_at', 'desc')->get();

        $activeMenu = 'catalog.product';
        return view('admin.catalogs.product.project.index', compact('product', 'project', 'activeMenu'));
    }

    public function create($productId)
    {
        $product = ProductModel::findOrFail($productId);
        $activeMenu = 'catalog.product';
        return view('admin.catalogs.product.project.create', compact('product', 'activeMenu'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $product = ProductModel::findOrFail($productId);

        ProductProjectModel::create([
            'product_id' => $productId,
            'title' => $request->title,
            'img' => ''
        ]);

        return redirect()->route('admin.catalog.product.project.index', $productId)
                         ->with('success', 'Project created successfully.');
    }

    public function edit($productId, $id)
    {
        $product = ProductModel::findOrFail($productId);
        $project = ProductProjectModel::findOrFail($id);

        $activeMenu = 'catalog.product';
        return view('admin.catalogs.product.project.edit', compact('product', 'project', 'activeMenu'));
    }

    public function update(Request $request, $productId, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
        ]);

        $data = [
            'title' => $request->title,
        ];

        $product = ProductModel::findOrFail($productId);
        $project = ProductProjectModel::findOrFail($id);

        $project->update($data);

        return redirect()->route('admin.catalog.product.project.index', $productId)
                         ->with('success', 'Project updated successfully.');
    }

    public function destroy($productId, $id)
    {
        $project = ProductProjectModel::findorfail($id);

        $project->delete();

        return redirect()->route('admin.catalog.product.project.index', $productId)
                         ->with('success', 'Project deleted successfully.');
    }
}
