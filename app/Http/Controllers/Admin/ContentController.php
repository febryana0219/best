<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ContentModel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function banner()
    {
        $tiles = [];

        for ($i = 1; $i <= 3; $i++) {
            $tiles[$i]['picture'] = ContentModel::where('name', "tile_{$i}_picture")->first();
            $tiles[$i]['title'] = ContentModel::where('name', "tile_{$i}_title")->first();
            $tiles[$i]['button'] = ContentModel::where('name', "tile_{$i}_button")->first();
            $tiles[$i]['link'] = ContentModel::where('name', "tile_{$i}_link")->first();
        }

        $activeMenu = 'homepage.banner';

        return view('admin.home_page.banner.edit', compact('tiles', 'activeMenu'));
    }

    public function banner_update(Request $request)
    {
        $request->validate([
            'title' => 'required|array',
            'button' => 'required|array',
            'link' => 'required|array',
            'title.*' => 'string|max:255',
            'button.*' => 'string|max:255',
            'link.*' => 'url|max:255',
            'picture' => 'nullable|array',
            'picture.*' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif',
        ]);

        foreach ($request->title as $index => $title) {
            ContentModel::where('name', "tile_{$index}_title")->update(['value' => $title]);
            ContentModel::where('name', "tile_{$index}_button")->update(['value' => $request->button[$index]]);
            ContentModel::where('name', "tile_{$index}_link")->update(['value' => $request->link[$index]]);

            $oldPicture = ContentModel::where('name', "tile_{$index}_picture")->first()->value;

            if ($request->hasFile("picture.$index")) {
                $currentDateTime = now()->format('Ymd-His');

                $file = $request->file("picture.$index");
                $fileSize = $file->getSize();
                $fileSizeInKB = $fileSize / 1024;

                $image = Image::make($file)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $fileName = "banner-" . $index . "-" . $currentDateTime . "." . $file->getClientOriginalExtension();

                if ($fileSizeInKB > 800) {
                    $image->save(storage_path("app/public/uploads/content/{$fileName}"), 90);
                } else {
                    $image->save(storage_path("app/public/uploads/content/{$fileName}"));
                }

                if ($oldPicture) {
                    Storage::delete("public/uploads/content/{$oldPicture}");
                }

                ContentModel::where('name', "tile_{$index}_picture")->update(['value' => $fileName]);
            }
        }

        return redirect()->route('admin.homepage.banner.index')->with('success', 'Banner updated successfully.');
    }

    public function seo()
    {
        $fields = [
            'home_meta_title',
            'home_meta_keyword',
            'home_meta_description',
            'home_title',
            'home_description',

            'about_meta_title',
            'about_meta_keyword',
            'about_meta_description',

            'contact_meta_title',
            'contact_meta_keyword',
            'contact_meta_description',

            'product_meta_title',
            'product_meta_keyword',
            'product_meta_description',

            'authorized_meta_title',
            'authorized_meta_keyword',
            'authorized_meta_description'
        ];

        $seoData = ContentModel::whereIn('name', $fields)->get()->keyBy('name');

        $activeMenu = 'system.seo';
        return view('admin.systems.seo.edit', compact('seoData', 'activeMenu'));
    }

    public function seo_update(Request $request)
    {
        $fields = [
            'home_meta_title',
            'home_meta_keyword',
            'home_meta_description',
            'home_title',
            'home_description',

            'about_meta_title',
            'about_meta_keyword',
            'about_meta_description',

            'contact_meta_title',
            'contact_meta_keyword',
            'contact_meta_description',

            'product_meta_title',
            'product_meta_keyword',
            'product_meta_description',

            'authorized_meta_title',
            'authorized_meta_keyword',
            'authorized_meta_description'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                ContentModel::updateOrCreate(
                    ['name' => $field],
                    ['value' => $request->input($field)]
                );
            }
        }

        return redirect()->back()->with('success', 'SEO settings updated successfully!');
    }


    public function footer()
    {
        $contactFooter = ContentModel::where('name', 'contact_footer')->first();
        $copyright = ContentModel::where('name', 'copyright')->first();

        $activeMenu = 'homepage.footer';
        return view('admin.home_page.footer.edit', compact('contactFooter', 'copyright', 'activeMenu'));
    }

    public function footer_update(Request $request)
    {
        $request->validate([
            'contact_footer' => 'required|string',
            'copyright' => 'required|string|max:255',
        ]);

        $contactFooter = ContentModel::where('name', 'contact_footer')->first();
        if ($contactFooter) {
            $contactFooter->value = $request->input('contact_footer');
            $contactFooter->save();
        }

        $copyright = ContentModel::where('name', 'copyright')->first();
        if ($copyright) {
            $copyright->value = $request->input('copyright');
            $copyright->save();
        }

        return redirect()->route('admin.homepage.footer.index')->with('success', 'Footer updated successfully!');
    }
}
