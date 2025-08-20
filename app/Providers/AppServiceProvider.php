<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use App\Models\Admin\EmailModel;
use App\Models\Admin\ContentModel;
use App\Models\Admin\ContactMapModel;
use App\Models\Admin\SocialLinkModel;
use App\Models\Admin\CategoryModel;
use App\Models\Admin\ConfigModel;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Konfigurasi email
        $this->configureEmail();

        // View composer untuk data yang sering digunakan
        View::composer('*', function ($view) {
            $view->with([
                'spCopyright' => ContentModel::select('value')->where('name', 'copyright')->first(),
                'spWhatsapp' => ContentModel::select('value')->where('name', 'contact_whatsapp')->first(),
                'spHomeMeta' => ContentModel::select('value')->where('name', 'home_meta_title')->first(),
                'spSocialLink' => SocialLinkModel::select('link', 'icon')->where('publish', 1)->orderBy('order_id')->get(),
                'spContactAddress' => ContactMapModel::select('name', 'address')->where('id', 1)->first(),
                'spCategoryList' => CategoryModel::select('permalink', 'name')->where('publish', 1)->orderBy('order_id', 'asc')->get(),
                'spEmail' => ConfigModel::select('value')->where('name', 'no_reply_email')->first(),
            ]);
        });
    }

    protected function configureEmail()
    {
        $emailConfig = EmailModel::first();

        if ($emailConfig) {
            Config::set('mail.default', 'smtp');
            Config::set('mail.mailers.smtp', [
                'transport' => 'smtp',
                'host' => $emailConfig->mail_host,
                'port' => $emailConfig->mail_port,
                'username' => $emailConfig->mail_username,
                'password' => $emailConfig->mail_password,
                'encryption' => $emailConfig->mail_encryption,
                'timeout' => null,
            ]);
            Config::set('mail.from', [
                'address' => $emailConfig->mail_from_address,
                'name' => $emailConfig->mail_from_name,
            ]);
        } else {
            \Log::warning('Konfigurasi email tidak ditemukan di database.');
        }
    }
}
