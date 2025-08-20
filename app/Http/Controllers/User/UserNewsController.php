<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\NewsModel;
use App\Models\Admin\BgModel;
use App\Models\Admin\ContentModel;
use Illuminate\Support\Facades\Crypt;

class UserNewsController extends Controller
{
    public function index()
    {
        $activeMenu = 'news';
        $metaTitle = 'News';

        $news = NewsModel::select('id', 'title', 'description', 'img', 'created_at', 'created_by')
            ->with('creator')
            ->where('publish', 1)
            ->orderBy('id', 'desc')
            ->paginate(9);
        $bg = BgModel::select('image')->where('title', 'News')->first();
        $metaData = ContentModel::whereIn('name', ['home_meta_keyword', 'home_meta_description'])->pluck('value', 'name');

        $metaKeyword = $metaData['home_meta_keyword'] ?? null;
        $metaDescription = $metaData['home_meta_description'] ?? null;

        return view('user.news.news', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'news' => $news,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
        ]);
    }

    public function show($encryptedId)
    {
        $activeMenu = 'news';
        $metaTitle = 'News Details';

        $id = Crypt::decrypt($encryptedId);
        $news = NewsModel::select('id', 'title', 'description', 'img', 'created_at', 'created_by')
            ->with('creator')
            ->findOrFail($id);
        $bg = BgModel::select('image')->where('title', 'News')->first();
        $metaData = ContentModel::whereIn('name', ['home_meta_keyword', 'home_meta_description'])->pluck('value', 'name');

        $metaKeyword = $metaData['home_meta_keyword'] ?? null;
        $metaDescription = $metaData['home_meta_description'] ?? null;

        return view('user.news.news_detail', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'news' => $news,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
        ]);
    }
}
