<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImageModel extends Model
{
    use HasFactory;

    protected $table = 'project_image';

    protected $fillable = [
        'project_id',
        'img',
        'name',
    ];

    public function project()
    {
        return $this->belongsTo(QualityControlModel::class, 'project_id');
    }
}
