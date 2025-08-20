<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogModel extends Model
{
    use HasFactory;

    protected $table = 'catalog';

    protected $fillable = [
        'category_id',
        'name',
        'file',
    ];
}
