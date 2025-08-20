<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = ['category_id', 'name', 'subtitle', 'description', 'video', 'permalink', 'publish', 'order_category'];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    public function defaultImage()
    {
        return $this->hasOne(ProductImageModel::class, 'product_id')
                    ->where('publish', 1)
                    ->where('as_default', 1)
                    ->orderBy('order_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImageModel::class, 'product_id')
                    ->where('publish', 1)
                    ->orderBy('order_id');
    }

    public function projects()
    {
        return $this->hasMany(ProductProjectModel::class, 'product_id');
    }
}
