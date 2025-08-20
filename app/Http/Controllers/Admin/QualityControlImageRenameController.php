<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\QualityControlImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class QualityControlImageRenameController extends Controller
{
    public function renameImages()
    {
        $images = QualityControlImageModel::all();

        $storagePath = storage_path('app/public/uploads/quality_control_detail');

        foreach ($images as $image) {
            $currentFileName = $image->img;
            $newFileName = $image->img_new;

            $currentFilePath = $storagePath . '/' . $currentFileName;

            $newFilePath = $storagePath . '/' . $newFileName;

            if (File::exists($currentFilePath)) {
                File::move($currentFilePath, $newFilePath);
            }
        }

        return response()->json(['message' => 'Files renamed successfully.']);
    }
}
