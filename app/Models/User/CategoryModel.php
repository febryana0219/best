<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = ['name', 'permalink', 'publish', 'order_id'];
    public function products()
    {
        return $this->hasMany(ProductModel::class, 'category_id')->where('publish', 1)->orderBy('order_category');
    }
}
