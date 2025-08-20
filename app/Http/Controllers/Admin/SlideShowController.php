<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SlideshowModel;
use Illuminate\Support\Facades\Storage;

class SlideShowController extends Controller
{
    public function index()
    {
        $slide_show = SlideshowModel::orderBy('order_id', 'asc')->get();
        $activeMenu = 'homepage.slide_show';
        return view('admin.home_page.slide_show.index', compact('slide_show', 'activeMenu'));
    }

    public function create()
    {
        $activeMenu = 'homepage.slide_show';
        return view('admin.home_page.slide_show.create', compact('activeMenu'));
    }

    public function store(Request $request)
    {
        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:200',
            'url' => 'nullable|string|max:255',
            'img_landscape' => 'required|file|mimes:jpeg,jpg,png,gif', // Max 10MB
            'img_portrait' => 'nullable|file|mimes:jpeg,jpg,png,gif',  // Max 10MB
        ]);

        $subtitle = $request->input('subtitle', '');
        $url = $request->input('url', '');
        $landscapeFileName = '';
        $portraitFileName = '';

        if ($request->hasFile('img_landscape')) {
            $landscapeFile = $request->file('img_landscape');
            $landscapeFileName = 'SSP-' . $currentDateTime . '.' . $landscapeFile->getClientOriginalExtension();

            $landscapeFile->storeAs('public/uploads/slide_show', $landscapeFileName);
        }

        if ($request->hasFile('img_portrait')) {
            $portraitFile = $request->file('img_portrait');
            $portraitFileName = 'SSP-' . $currentDateTime . '.' . $portraitFile->getClientOriginalExtension();

            $portraitFile->storeAs('public/uploads/slide_show', $portraitFileName);
        }

        SlideshowModel::create([
            'title' => $request->title,
            'subtitle' => $subtitle,
            'url' => $url,
            'img_landscape' => $landscapeFileName,
            'img_portrait' => $portraitFileName,
            'order_id' => SlideshowModel::max('order_id') + 1,
        ]);

        return redirect()->route('admin.homepage.slide_show.index')
                            ->with('success', 'Slide show created successfully.');
    }

    public function edit($id)
    {
        $slide_show = SlideshowModel::findOrFail($id);
        $activeMenu = 'homepage.slide_show';
        return view('admin.home_page.slide_show.edit', compact('slide_show', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $slideshow = SlideshowModel::findOrFail($id);

        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:200',
            'url' => 'nullable|string|max:255',
            'img_landscape' => 'nullable|file|mimes:jpeg,jpg,png,gif', // Max 10MB
            'img_portrait' => 'nullable|file|mimes:jpeg,jpg,png,gif',  // Max 10MB
        ]);

        if ($request->hasFile('img_landscape')) {
            $landscapeFile = $request->file('img_landscape');
            $landscapeFileName = 'SSP-' . $currentDateTime . '.' . $landscapeFile->getClientOriginalExtension();

            $landscapeFile->storeAs('public/uploads/slide_show', $landscapeFileName);

            if ($slideshow->img_landscape) {
                Storage::delete("public/uploads/slide_show/{$slideshow->img_landscape}");
            }

            $slideshow->img_landscape = $landscapeFileName;
        }

        if ($request->hasFile('img_portrait')) {
            $portraitFile = $request->file('img_portrait');
            $portraitFileName = 'SSP-' . $currentDateTime . '.' . $portraitFile->getClientOriginalExtension();

            $portraitFile->storeAs('public/uploads/slide_show', $portraitFileName);

            if ($slideshow->img_portrait) {
                Storage::delete("public/uploads/slide_show/{$slideshow->img_portrait}");
            }

            $slideshow->img_portrait = $portraitFileName;
        }

        $slideshow->title = $request->title;
        $slideshow->subtitle = $request->subtitle;
        $slideshow->url = $request->input('url', '') ?: '';

        $slideshow->save();

        return redirect()->route('admin.homepage.slide_show.index')
                        ->with('success', 'Slide show updated successfully.');
    }


    public function order()
    {
        $slide_show = SlideshowModel::orderBy('order_id')->get();
        $activeMenu = 'homepage.slide_show';
        return view('admin.home_page.slide_show.order', compact('slide_show', 'activeMenu'));
    }

    public function updateOrder(Request $request)
    {
        $orderIds = $request->input('order');

        foreach ($orderIds as $order_id => $id) {
            SlideshowModel::where('id', $id)->update(['order_id' => $order_id + 1]);
        }

        return redirect()->route('admin.homepage.slide_show.order')->with('success', 'Order updated successfully.');
    }

    public function update_publish(Request $request, $id)
    {
        $request->validate([
            'publish' => 'required|boolean',
        ]);

        $slide_show = SlideshowModel::findOrFail($id);

        if (!$slide_show) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $slide_show->publish = $request->publish ? 1 : 0;
        $slide_show->save();

        return response()->json(['message' => 'Publish status updated successfully.']);
    }

    public function destroy($id)
    {
        $slideShow = SlideshowModel::findOrFail($id);

        $landscapeFilePath = 'uploads/slide_show/' . $slideShow->img_landscape;
        $portraitFilePath = 'uploads/slide_show/' . $slideShow->img_portrait;

        if ($slideShow->img_landscape && Storage::disk('public')->exists($landscapeFilePath)) {
            Storage::disk('public')->delete($landscapeFilePath);
        }

        if ($slideShow->img_portrait && Storage::disk('public')->exists($portraitFilePath)) {
            Storage::disk('public')->delete($portraitFilePath);
        }

        $slideShow->delete();

        return redirect()->route('admin.homepage.slide_show.index')
                         ->with('success', 'Slide show deleted successfully.');
    }
}
