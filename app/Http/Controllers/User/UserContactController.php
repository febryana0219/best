<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ContactMapModel;
use App\Models\Admin\ConfigModel;
use App\Models\Admin\ContentModel;
use App\Models\Admin\BgModel;

class UserContactController extends Controller
{
    public function index()
    {
        $activeMenu = 'contact';
        $contactAddress = ContactMapModel::where('id', 1)->first();
        $bg = BgModel::select('image')->where('title', 'Contact')->first();
        $metaData = ContentModel::whereIn('name', ['contact_meta_title', 'contact_meta_keyword', 'contact_meta_description'])->pluck('value', 'name');
        $address = ConfigModel::select('value')->where('name', 'address')->first();
        $phone = ConfigModel::select('value')->where('name', 'phone')->first();

        $metaTitle = $metaData['contact_meta_title'] ?? null;
        $metaKeyword = $metaData['contact_meta_keyword'] ?? null;
        $metaDescription = $metaData['contact_meta_description'] ?? null;

        return view('user.contact', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'contactAddress' => $contactAddress,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
            'address' => $address,
            'phone' => $phone,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        ContactMessageModel::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message')
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

}
