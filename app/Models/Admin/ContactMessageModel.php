<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessageModel extends Model
{
    use HasFactory;

    protected $table = 'contact_message';
    protected $fillable = [
        'name',
        'company',
        'email',
        'subject',
        'message'
    ];

    public $timestamps = true;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}


