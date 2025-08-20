<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $fillable = [
        'name',
        'permalink',
        'publish',
        'order_id',
        'meta_title',
        'meta_description',
        'meta_keyword'
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
            $category->order_id = CategoryModel::max('order_id') + 1;
            // Set default values for meta fields if not set
            $category->meta_title = $category->meta_title ?? '';
            $category->meta_description = $category->meta_description ?? '';
            $category->meta_keyword = $category->meta_keyword ?? '';
        });
    }
}
