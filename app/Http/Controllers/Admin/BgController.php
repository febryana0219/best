<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\BgModel;
use Illuminate\Support\Facades\Storage;

class BgController extends Controller
{
    public function index()
    {
        $bg = BgModel::orderBy('id', 'asc')->get();
        $activeMenu = 'system.bg';
        return view('admin.systems.background.index', compact('bg', 'activeMenu'));
    }

    public function edit($id)
    {
        $bg = BgModel::findOrFail($id);
        $activeMenu = 'system.bg';
        return view('admin.systems.background.edit', compact('bg', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $bg = BgModel::findOrFail($id);

        $currentDateTime = now()->format('Ymd-His');

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|file|max:10240|mimes:jpeg,jpg,png,gif', // Max 10MB
        ]);

        if ($request->hasFile('image')) {
            $imgFile = $request->file('image');

            $imgFileName = 'BG-' . $currentDateTime . '.' . $imgFile->getClientOriginalExtension();
            $imgFile->storeAs('public/uploads/bg', $imgFileName);

            if ($bg->image) {
                Storage::delete("public/uploads/bg/{$bg->image}");
            }

            $bg->image = $imgFileName;
        }

        $bg->title = $request->title;
        $bg->save();

        return redirect()->route('admin.system.bg.index')
                        ->with('success', 'Background updated successfully.');
    }
}
