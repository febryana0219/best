<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideshowModel extends Model
{
    use HasFactory;

    protected $table = 'home_slideshow';
    protected $fillable = [
        'title',
        'subtitle',
        'url',
        'order_id',
        'img_landscape',
        'img_portrait',
        'publish',
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($slideshow) {
            $slideshow->order_id = SlideshowModel::max('order_id') + 1;
            $slideshow->subtitle = $slideshow->subtitle ?? '';
            $slideshow->url = $slideshow->url ?? '';
        });

        static::updating(function ($slideshow) {
            $slideshow->url = $slideshow->url ?: null; // Handle null for updating as well
        });
    }
}
