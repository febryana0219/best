<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLinkModel extends Model
{
    use HasFactory;

    protected $table = 'social_link';
    protected $fillable = [
        'name',
        'link',
        'icon',
        'publish',
        'order_id'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
