<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\CategoryModel;
use App\Models\Admin\ProductModel;
use App\Models\Admin\ProductImageModel;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $product = ProductModel::with(['category', 'images'])
            ->orderBy('id', 'desc')
            ->get();

        $activeMenu = 'catalog.product';
        return view('admin.catalogs.product.index', compact('product', 'activeMenu'));
    }


    public function create()
    {
        $category = CategoryModel::all();
        $activeMenu = 'catalog.product';
        return view('admin.catalogs.product.create', compact('category', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:60',
            'category_id' => 'required|exists:category,id',
            'publish' => 'required',
            'description' => 'required|string',
        ]);

        $permalink = str_replace(' ', '-', $request->name);

        $product = ProductModel::create([
            'name' => $request->name,
            'subtitle' => $request->subtitle,
            'category_id' => $request->category_id,
            'publish' => $request->publish,
            'description' => $request->description,
            'permalink' => $permalink,
            'order_category' => $this->getOrderCategory($request->category_id)
        ]);

        return redirect()->route('admin.catalog.product.edit', ['id' => $product->id])
                         ->with('success', 'Product created successfully! Now you can add product images.');
    }

    private function getOrderCategory($categoryId)
    {
        $maxOrder = ProductModel::where('category_id', $categoryId)->max('order_category');

        return $maxOrder ? $maxOrder + 1 : 1;
    }

    public function edit($id)
    {
        $category = CategoryModel::all();
        $product = ProductModel::with(['category', 'images'])->findOrFail($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $activeMenu = 'catalog.product';
        return view('admin.catalogs.product.edit', compact('category', 'product', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:60',
            'category_id' => 'required|exists:category,id',
            'publish' => 'required',
            'description' => 'required|string',
            'img' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',
        ]);

        $product = ProductModel::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'subtitle' => $request->subtitle,
            'category_id' => $request->category_id,
            'publish' => $request->publish,
            'description' => $request->description,
            'video' => $request->video,
        ]);

        if ($request->hasFile('img')) {
            $imgFile = $request->file('img');

            $imgCount = ProductImageModel::where('product_id', $product->id)->count();

            $formattedName = strtolower(str_replace(' ', '-', $product->name));
            $imageName = $formattedName . '-' . ($imgCount + 1) . '.' . $imgFile->getClientOriginalExtension();

            // Simpan langsung tanpa resize/kompres
            $imgFile->storeAs('public/uploads/product', $imageName);

            ProductImageModel::create([
                'product_id' => $product->id,
                'img' => $imageName,
                'as_default' => $imgCount == 0 ? 1 : 0,
                'publish' => 1,
            ]);
        }

        if ($request->input('action_type') == 'save_exit') {
            return redirect()->route('admin.catalog.product.index')
                             ->with('success', 'Product updated successfully!');
        }

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function update_publish(Request $request, $id)
    {
        $request->validate([
            'publish' => 'required|boolean',
        ]);

        $product = ProductModel::findOrFail($id);

        if (!$product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $product->publish = $request->publish ? 1 : 0;
        $product->save();

        return response()->json(['message' => 'Publish status updated successfully.']);
    }


    public function order(Request $request)
    {
        $categories = CategoryModel::orderBy('order_id')->get();

        $categoryId = $request->input('category_id');

        $products = collect();

        if ($categoryId) {
            $products = ProductModel::where('category_id', $categoryId)
                ->orderBy('order_category')
                ->get();
        }

        $activeMenu = 'catalog.category';

        return view('admin.catalogs.product.order', compact('categories', 'products', 'activeMenu', 'categoryId'));
    }


    public function updateOrder(Request $request)
    {
        $orderIds = $request->input('order');

        foreach ($orderIds as $order_id => $id) {
            ProductModel::where('id', $id)->update(['order_category' => $order_id + 1]);
        }

        return back()->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $product = ProductModel::with('images')->findOrFail($id);

        foreach ($product->images as $image) {
            Storage::disk('public')->delete("uploads/product/{$image->img}");
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.catalog.product.index')
                         ->with('success', 'Product deleted successfully!');
    }
}


