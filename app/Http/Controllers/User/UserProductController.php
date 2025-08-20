<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\CategoryModel;
use App\Models\User\ProductModel;
use App\Models\Admin\ContentModel;
use App\Models\Admin\BgModel;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index($permalink = null)
    {
        $activeMenu = 'product';

        $category = null;
        $products = null;

        if ($permalink) {
            $category = CategoryModel::where('permalink', $permalink)->where('publish', 1)->firstOrFail();
            $products = $category->products()->with('defaultImage')->get();
        } else {
            $products = ProductModel::where('publish', 1)
                ->with(['category', 'defaultImage'])
                ->orderBy('order_category')
                ->get();
        }

        $bg = BgModel::select('image')->where('title', 'Product')->first();
        $metaData = ContentModel::whereIn('name', ['product_meta_title', 'product_meta_keyword', 'product_meta_description'])->pluck('value', 'name');

        $metaTitle = $metaData['product_meta_title'] ?? null;
        $metaKeyword = $metaData['product_meta_keyword'] ?? null;
        $metaDescription = $metaData['product_meta_description'] ?? null;

        return view('user.products.product', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function show($category_permalink, $product_permalink)
    {
        $activeMenu = 'product';

        $category = CategoryModel::where('permalink', $category_permalink)->firstOrFail();

        $product = ProductModel::where('permalink', $product_permalink)
            ->where('category_id', $category->id)
            ->with(['category', 'defaultImage', 'images', 'projects'])
            ->firstOrFail();

        $bg = BgModel::where('title', 'Product')->first();
        $metaData = ContentModel::whereIn('name', ['product_meta_title', 'product_meta_keyword', 'product_meta_description'])->pluck('value', 'name');

        $metaTitle = $metaData['product_meta_title'] ?? null;
        $metaKeyword = $metaData['product_meta_keyword'] ?? null;
        $metaDescription = $metaData['product_meta_description'] ?? null;

        $previousUrl = url()->previous();

        return view('user.products.detail', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
            'category' => $category,
            'product' => $product,
            'previousUrl' => $previousUrl,
        ]);
    }
}
