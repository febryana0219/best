<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AboutModel;
use App\Models\Admin\ContentModel;
use App\Models\Admin\BgModel;

class UserAboutController extends Controller
{
    public function index()
    {
        $activeMenu = 'about';
        $about = AboutModel::select('title', 'description', 'img1', 'img2')->find(1);
        $bg = BgModel::select('image')->where('title', 'About')->first();
        $metaData = ContentModel::whereIn('name', ['about_meta_title', 'about_meta_keyword', 'about_meta_description'])->pluck('value', 'name');

        $metaTitle = $metaData['about_meta_title'] ?? null;
        $metaKeyword = $metaData['about_meta_keyword'] ?? null;
        $metaDescription = $metaData['about_meta_description'] ?? null;

        return view('user.about', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'about' => $about,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
        ]);
    }
}
