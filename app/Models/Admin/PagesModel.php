<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagesModel extends Model
{
    use HasFactory;

    protected $table = 'page';
    protected $fillable = [
        'name',
        'description',
        'img',
        'custom_page',
        'page_type',
        'permalink',
        'url',
    ];
}
