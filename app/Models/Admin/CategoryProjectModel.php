<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProjectModel extends Model
{
    use HasFactory;

    protected $table = 'category_project';
    protected $fillable = [
        'name',
        'permalink',
        'publish',
        'order_id'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Automatically generate permalink and order_id on saving
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            // Generate permalink
            $category->permalink = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $category->name)));
            // Set order_id
            $category->order_id = CategoryProjectModel::max('order_id') + 1;
        });
    }
}
