<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControlDetailModel extends Model
{
    use HasFactory;

    protected $table = 'project_detail';

    protected $fillable = [
        'project_id',
        'equipment_code',
        'production_number',
        'date',
        'contractor_name',
        'pipe_type',
        'pipe_size',
        'pipe_qty',
        'pipe_length',
        'jacketing_type',
        'jacketing_size',
        'jacket_od',
        'density',
        'thickness_pu_1',
        'thickness_pu_2',
        'thickness_pu_3',
        'thickness_pu_4',
        'tolerance',
    ];

    protected $dates = ['date'];

    public function projectHeader()
    {
        return $this->belongsTo(QualityControlModel::class, 'project_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(QualityControlImageModel::class, 'detail_id', 'id');
    }
}
