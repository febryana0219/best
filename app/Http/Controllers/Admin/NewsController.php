<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\NewsModel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $activeMenu = 'static_page.news';
        $news = NewsModel::orderBy('id', 'desc')->paginate(10);
        return view('admin.manage_static_page.news.index', compact('activeMenu', 'news'));
    }

    public function create()
    {
        $activeMenu = 'static_page.news';
        return view('admin.manage_static_page.news.create', compact('activeMenu'));
    }

    public function store(Request $request)
    {
        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'img' => 'required|file|max:100000|mimes:jpeg,jpg,png,gif', // Max 10MB
            'publish' => 'required|integer',
            'created_by' => 'required|integer',
        ]);

        $imgFileName = null;

        if ($request->hasFile('img')) {
            $imgFile = $request->file('img');

            $currentDateTime = now()->format('YmdHis');
            $imgFileName = 'NEWS-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            // simpan original tanpa resize & tanpa compress
            $imgFile->storeAs('public/uploads/news', $imgFileName);
        }

        NewsModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'img' => $imgFileName,
            'publish' => $request->publish,
            'created_by' => $request->created_by,
            'updated_by' => $request->created_by,
        ]);

        return redirect()->route('admin.static_page.news.index')
                         ->with('success', 'News created successfully.');
    }

    public function edit($id)
    {
        $activeMenu = 'static_page.news';
        $news = NewsModel::findOrFail($id);
        return view('admin.manage_static_page.news.edit', compact('activeMenu', 'news'));
    }

    public function update(Request $request, $id)
    {
        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'img' => 'nullable|file|max:100000|mimes:jpeg,jpg,png,gif', // Max 10MB
            'publish' => 'required|integer',
            'updated_by' => 'required|integer',
        ]);

        $news = NewsModel::findOrFail($id);

        if ($request->hasFile('img')) {
            $imgFile = $request->file('img');

            $currentDateTime = now()->format('YmdHis');
            $imgFileName = 'NEWS-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();

            // simpan original tanpa resize & tanpa compress
            $imgFile->storeAs('public/uploads/news', $imgFileName);

            // hapus gambar lama kalau ada
            if ($news->img && Storage::disk('public')->exists("uploads/news/{$news->img}")) {
                Storage::disk('public')->delete("uploads/news/{$news->img}");
            }

            // update field img
            $news->img = $imgFileName;
        }

        $news->update([
            'title' => $request->title,
            'description' => $request->description,
            'publish' => $request->publish,
            'updated_by' => $request->updated_by,
        ]);

        return redirect()->route('admin.static_page.news.index')
                         ->with('success', 'News updated successfully.');
    }

    public function update_publish(Request $request, $id)
    {
        $request->validate([
            'publish' => 'required|boolean',
        ]);

        $news = NewsModel::findOrFail($id);

        if (!$news) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $news->publish = $request->publish ? 1 : 0;
        $news->save();

        return response()->json(['message' => 'Publish status updated successfully.']);
    }

    public function destroy($id)
    {
        $news = NewsModel::findOrFail($id);

        if ($news->img && Storage::disk('public')->exists("uploads/news/{$news->img}")) {
            Storage::disk('public')->delete("uploads/news/{$news->img}");
        }

        $news->delete();

        return redirect()->route('admin.static_page.news.index')
                         ->with('success', 'News deleted successfully.');
    }
}
