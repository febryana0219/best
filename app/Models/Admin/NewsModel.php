<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'description',
        'img',
        'publish',
        'created_by',
        'updated_by',
    ];

    public $timestamps = false;

    public function creator()
    {
        return $this->belongsTo(AdministratorModel::class, 'created_by', 'id');
    }
}
