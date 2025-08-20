<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityControlImageModel extends Model
{
    use HasFactory;

    protected $table = 'project_detail_image';

    protected $fillable = [
        'project_id',
        'detail_id',
        'name',
        'img',
        'order_id',
    ];

    public function projectDetail()
    {
        return $this->belongsTo(QualityControlDetailModel::class, 'detail_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($map) {
            $maxOrderId = QualityControlImageModel::where('detail_id', $map->detail_id)->max('order_id');
            $map->order_id = $maxOrderId ? $maxOrderId + 1 : 1;
        });
    }
}
