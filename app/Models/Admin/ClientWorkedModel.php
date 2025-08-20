<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientWorkedModel extends Model
{
    use HasFactory;

    protected $table = 'client_worked';
    protected $fillable = [
        'name',
        'order_id',
        'img',
        'publish',
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($slideshow) {
            $slideshow->order_id = ClientWorkedModel::max('order_id') + 1;
        });
    }
}
