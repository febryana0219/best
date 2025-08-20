<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProductImageModel;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function set_default(Request $request, $id)
    {
        $request->validate([
            'as_default' => 'required|boolean',
        ]);

        $product_image = ProductImageModel::findOrFail($id);

        if (!$product_image) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $productId = $product_image->product_id;

        if ($request->as_default) {
            ProductImageModel::where('product_id', $productId)
                ->where('id', '!=', $id)
                ->update(['as_default' => 0]);
        }

        $product_image->as_default = $request->as_default ? 1 : 0;
        $product_image->save();

        return response()->json(['message' => 'Default image updated successfully.']);
    }


    public function publish(Request $request, $id)
    {
        $request->validate([
            'publish' => 'required|boolean',
        ]);

        $product_image = ProductImageModel::findOrFail($id);

        if (!$product_image) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $product_image->publish = $request->publish ? 1 : 0;
        $product_image->save();

        return response()->json(['message' => 'Publish status updated successfully.']);
    }

    public function destroy($id)
    {
        $product_image = ProductImageModel::findorfail($id);
        $filePath = 'uploads/product/' . $product_image->img;

        Storage::disk('public')->delete($filePath);

        $product_image->delete();

        return redirect()->back()->with('success', 'Product image deleted successfully!');
    }
}
