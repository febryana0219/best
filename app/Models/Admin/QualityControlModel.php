<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControlModel extends Model
{
    use HasFactory;

    protected $table = 'project';

    protected $fillable = [
        'name',
        'project_date',
        'client',
        'product',
        'project_info',
        'category_id',
        'image',
        'password',
        'password_access',
        'permalink',
        'publish',
    ];

    protected $hidden = ['password', 'password_access'];

    public function category()
    {
        return $this->belongsTo(CategoryProjectModel::class, 'category_id', 'id');
    }

    public function imgDetails()
    {
        return $this->hasMany(ProjectImageModel::class, 'project_id', 'id');
    }
}
