<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProjectModel extends Model
{
    use HasFactory;

    protected $table = 'product_project';
    protected $fillable = [
        'product_id',
        'title',
        'description',
    ];
}
