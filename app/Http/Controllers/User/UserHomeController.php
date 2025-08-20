<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SlideshowModel;
use App\Models\Admin\ClientWorkedModel;
use App\Models\Admin\AboutModel;
use App\Models\Admin\ContentModel;
use App\Models\Admin\QualityControlModel;
use App\Models\Admin\NewsModel;

class UserHomeController extends Controller
{
    public function index()
    {
        $activeMenu = 'home';
        $metaData = ContentModel::whereIn('name', ['home_meta_title', 'home_meta_keyword', 'home_meta_description'])
            ->pluck('value', 'name');
        $slideShow = SlideshowModel::select('img_landscape', 'title', 'subtitle', 'url')
            ->where('publish', 1)
            ->orderBy('order_id', 'asc')
            ->get();
        $about = AboutModel::select('title', 'description', 'img1', 'img2')
            ->where('id', 1)
            ->first();
        $clients = ClientWorkedModel::select('name', 'img')
            ->where('publish', 1)
            ->orderBy('order_id', 'asc')
            ->get();
        $projects = QualityControlModel::with('category')
            ->select('name', 'image', 'permalink', 'category_id')
            ->where('publish', 1)
            ->orderBy('name', 'asc')
            ->limit(10)
            ->get();
        $news = NewsModel::select('id', 'title', 'description', 'img', 'created_at', 'created_by')
            ->with('creator')
            ->where('publish', 1)
            ->orderBy('id', 'desc')
            ->limit(6)
            ->get();

        $metaTitle = $metaData['home_meta_title'] ?? null;
        $metaKeyword = $metaData['home_meta_keyword'] ?? null;
        $metaDescription = $metaData['home_meta_description'] ?? null;

        return view('user.home', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
            'slideShow' => $slideShow,
            'about' => $about,
            'clients' => $clients,
            'projects' => $projects,
            'news' => $news,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
        ]);
    }
}
