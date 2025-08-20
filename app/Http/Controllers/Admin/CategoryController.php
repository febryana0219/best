<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\CategoryModel;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryModel::orderBy('order_id')->get();
        $activeMenu = 'catalog.category';
        return view('admin.catalogs.category.index', compact('categories', 'activeMenu'));
    }

    public function create()
    {
        $activeMenu = 'catalog.category';
        return view('admin.catalogs.category.create', compact('activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'meta_title' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string|max:300',
        ]);

        $data = $request->all();
        $data['permalink'] = strtolower(str_replace(' ', '-', $request->name));
        $data['publish'] = 1;
        $data['order_id'] = CategoryModel::max('order_id') + 1;

        // Set default value null
        $data['meta_title'] = $data['meta_title'] ?? '';
        $data['meta_description'] = $data['meta_description'] ?? '';
        $data['meta_keyword'] = $data['meta_keyword'] ?? '';

        CategoryModel::create($data);
        return redirect()->route('admin.catalog.category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = CategoryModel::findorfail($id);
        $activeMenu = 'catalog.category';
        return view('admin.catalogs.category.edit', compact('category', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'meta_title' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string',
            'meta_keyword' => 'nullable|string|max:300',
        ]);

        $data = $request->all();
        $data['permalink'] = strtolower(str_replace(' ', '-', $request->name));

        $category = CategoryModel::findorfail($id);
        $category->update($data);

        return redirect()->route('admin.catalog.category.index')->with('success', 'Category updated successfully.');
    }

    public function order()
    {
        $categories = CategoryModel::orderBy('order_id')->get();
        $activeMenu = 'catalog.category';
        return view('admin.catalogs.category.order', compact('categories', 'activeMenu'));
    }

    public function updateOrder(Request $request)
    {
        $orderIds = $request->input('order');

        foreach ($orderIds as $order_id => $id) {
            CategoryModel::where('id', $id)->update(['order_id' => $order_id + 1]);
        }

        return redirect()->route('admin.catalog.category.order')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $category = CategoryModel::findorfail($id);
        $category->delete();
        return redirect()->route('admin.catalog.category.index')->with('success', 'Category deleted successfully.');
    }
}
