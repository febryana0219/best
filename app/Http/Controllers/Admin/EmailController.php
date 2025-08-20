<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\EmailModel;
use Illuminate\Support\Facades\Artisan;

class EmailController extends Controller
{
    public function index()
    {
        $activeMenu = 'system.email_career';
        $email = EmailModel::first();
        return view('admin.systems.email_career.index', compact('email', 'activeMenu'));
    }

    public function edit($id)
    {
        $activeMenu = 'system.email_career';
        $email = EmailModel::findOrFail($id);
        return view('admin.systems.email_career.edit', compact('email', 'activeMenu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'required|email',
            'mail_password' => 'required|string',
            'mail_encryption' => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
            'mail_hrd' => 'required|email',
        ]);

        $email = EmailModel::findOrFail($id);

        $email->update($request->only([
            'mail_host', 'mail_port',
            'mail_username', 'mail_password', 'mail_encryption',
            'mail_from_address', 'mail_from_name', 'mail_hrd'
        ]));

        $response = redirect()->route('admin.system.email_career.index')
            ->with('success', 'Email career updated successfully.');

        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:cache');

        return $response;
    }
}
