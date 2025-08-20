<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMapModel extends Model
{
    use HasFactory;

    protected $table = 'contact_map';
    protected $fillable = [
        'name',
        'address',
        'longitude',
        'latitude',
        'publish',
        'ordered_no'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($map) {
            $map->order_id = ContactMapModel::max('order_id') + 1;
        });
    }
}
