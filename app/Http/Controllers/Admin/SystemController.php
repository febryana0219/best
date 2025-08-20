<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ConfigModel;
use App\Models\Admin\NewsletterModel;

class SystemController extends Controller
{
    public function newsletter_index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort_field', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        $messages = NewsletterModel::when($search, function ($query, $search) {
            return $query->where('email', 'like', '%' . $search . '%');
        })
        ->orderBy($sortField, $sortDirection)
        ->paginate(10);

        $activeMenu = 'system.newsletter';
        return view('admin.systems.newsletter.index', compact('messages', 'activeMenu', 'search', 'sortField', 'sortDirection'));
    }

    // Email system
    public function edit_email()
    {
        $config = ConfigModel::where('name', 'no_reply_email')->first();
        $activeMenu = 'system.email';
        return view('admin.systems.email.edit', compact('config', 'activeMenu'));
    }

    // Phone system
    public function edit_phone()
    {
        $config = ConfigModel::where('name', 'phone')->first();
        $activeMenu = 'system.phone';
        return view('admin.systems.phone.edit', compact('config', 'activeMenu'));
    }

    // Phone system
    public function edit_address()
    {
        $config = ConfigModel::where('name', 'address')->first();
        $activeMenu = 'system.address';
        return view('admin.systems.address.edit', compact('config', 'activeMenu'));
    }

    // Google Analytics system
    public function edit_ga()
    {
        $config = ConfigModel::where('name', 'ga_code')->first();
        $activeMenu = 'system.ga';
        return view('admin.systems.google.edit', compact('config', 'activeMenu'));
    }

    // Universal update function
    public function update(Request $request, $systemName)
    {
        $rules = [
            'no_reply_email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'ga_code' => 'required|string',
        ];

        $request->validate([
            'value' => $rules[$systemName] ?? 'required|string',
        ]);

        if ($systemName == 'no_reply_email') {
            $link = 'email';
            $text = 'Email';
        } elseif ($systemName == 'phone') {
            $link = 'phone';
            $text = 'Phone';
        } elseif ($systemName == 'address') {
            $link = 'address';
            $text = 'Address';
        } elseif ($systemName == 'ga_code') {
            $link = 'ga';
            $text = 'Google analytics';
        }

        $config = ConfigModel::where('name', $systemName)->first();
        if ($config) {
            $config->value = $request->input('value');
            $config->save();

            return redirect()->route('admin.system.' . $link . '.edit')
                            ->with('success', $text . ' updated successfully!');
        }

        return redirect()->route('admin.system.' . $link . '.edit')
                        ->with('error', 'System not found.');
    }
}
