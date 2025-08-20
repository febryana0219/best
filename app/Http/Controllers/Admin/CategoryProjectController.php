<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\CategoryProjectModel;

class CategoryProjectController extends Controller
{
    public function index()
    {
        $categories = CategoryProjectModel::orderBy('order_id')->get();
        $activeMenu = 'qc.category';
        return view('admin.quality_control.category.index', compact('categories', 'activeMenu'));
    }

    public function create()
    {
        $activeMenu = 'qc.category';
        return view('admin.quality_control.category.create', compact('activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $data = $request->all();
        $data['permalink'] = strtolower(str_replace(' ', '-', $request->name));
        $data['publish'] = 1;
        $data['order_id'] = CategoryProjectModel::max('order_id') + 1;

        CategoryProjectModel::create($data);
        return redirect()->route('admin.qc.category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = CategoryProjectModel::findorfail($id);
        $activeMenu = 'qc.category';
        return view('admin.quality_control.category.edit', compact('category', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $data = $request->all();
        $data['permalink'] = strtolower(str_replace(' ', '-', $request->name));

        $category = CategoryProjectModel::findorfail($id);
        $category->update($data);

        return redirect()->route('admin.qc.category.index')->with('success', 'Category updated successfully.');
    }

    public function order()
    {
        $categories = CategoryProjectModel::orderBy('order_id')->get();
        $activeMenu = 'qc.category';
        return view('admin.quality_control.category.order', compact('categories', 'activeMenu'));
    }

    public function updateOrder(Request $request)
    {
        $orderIds = $request->input('order');

        foreach ($orderIds as $order_id => $id) {
            CategoryProjectModel::where('id', $id)->update(['order_id' => $order_id + 1]);
        }

        return redirect()->route('admin.qc.category.order')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $category = CategoryProjectModel::findorfail($id);
        $category->delete();
        return redirect()->route('admin.qc.category.index')->with('success', 'Category deleted successfully.');
    }
}
