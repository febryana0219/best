<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImageModel extends Model
{
    use HasFactory;

    protected $table = 'product_image';

    protected $fillable = [
        'product_id',
        'img',
        'as_default',
        'publish',
    ];

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
