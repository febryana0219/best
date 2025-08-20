<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentModel extends Model
{
    use HasFactory;

    protected $table = 'content';

    protected $fillable = ['name', 'value', 'flag_picture'];
}
