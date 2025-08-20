<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'subtitle',
        'category_id',
        'brand_id',
        'publish',
        'description',
        'video',
        'permalink',
        'order_category',
        'order_brand',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(BrandModel::class, 'brand_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImageModel::class, 'product_id')
            ->orderBy('as_default', 'desc')
            ->orderBy('id', 'asc');
    }

    public function defaultImage()
    {
        return $this->images()
            ->orderBy('as_default', 'desc')
            ->orderBy('id', 'asc')
            ->first();
    }
}
