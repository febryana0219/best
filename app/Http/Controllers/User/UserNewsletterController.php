<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\NewsletterModel;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\ConfigModel;
use App\Models\Admin\SocialLinkModel;

class UserNewsletterController extends Controller
{
    protected $address, $email, $socialLink;
    public function __construct() 
    {
        $this->address = ConfigModel::where('name', 'address')->first();
        $this->email = ConfigModel::where('name', 'no_reply_email')->first();
        $this->socialLink = SocialLinkModel::where('publish', 1)->orderBy('order_id')->get();
    }

    public function subscribe(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first('email')], 422);
        }

        $newsletter = new NewsletterModel();
        $newsletter->email = $request->email;
        $newsletter->save();

        return response()->json(['success' => 'Thank you for subscribing to our newsletter!'])
            ->with('address', $this->address)
            ->with('email', $this->email)
            ->with('socialLink', $this->socialLink);
    }
}
