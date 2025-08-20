<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\EmailModel;
use App\Models\Admin\BgModel;
use App\Models\Admin\ContentModel;

class UserCareerController extends Controller
{

    public function index()
    {
        $activeMenu = 'career';
        $metaTitle = 'Careers';

        $bg = BgModel::select('image')->where('title', 'Career')->first();
        $metaData = ContentModel::whereIn('name', ['home_meta_keyword', 'home_meta_description'])->pluck('value', 'name');

        $metaKeyword = $metaData['home_meta_keyword'] ?? null;
        $metaDescription = $metaData['home_meta_description'] ?? null;

        return view('user.careers.career', [
            'activeMenu' => $activeMenu,
            'metaTitle' => $metaTitle,
            'bg' => $bg,
            'metaKeyword' => $metaKeyword,
            'metaDescription' => $metaDescription,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'required|email',
            'cover_letter' => 'required|string',
            'cv' => 'required|mimes:pdf|max:2048',
        ]);

        $originalFileName = $request->file('cv')->getClientOriginalName();
        $cvPath = $request->file('cv')->storeAs('public/uploads/cv', $originalFileName);

        $emailConfig = EmailModel::find(1);

        if (!$emailConfig) {
            return back()->with('error', 'Konfigurasi email tidak ditemukan.');
        }

        try {
            $data = [
                'name' => "{$request->first_name} {$request->last_name}",
                'email' => $request->email,
                'cover_letter' => $request->cover_letter,
            ];

            Mail::send('user.careers.mail', $data, function ($message) use ($cvPath, $emailConfig, $originalFileName) {
                $message->to($emailConfig->mail_hrd)
                        ->subject('Melamar Pekerjaan')
                        ->attach(Storage::path($cvPath), [
                            'as' => $originalFileName,
                        ]);
            });

            Storage::delete($cvPath);

            return back()->with('success', 'Lamaran berhasil dikirim.');
        } catch (\Exception $e) {
            \Log::error('Error sending email: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengirim lamaran: ' . $e->getMessage());
        }
    }
}
