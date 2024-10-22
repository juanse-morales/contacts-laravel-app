<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPhoto extends Model
{
    use HasFactory;

    protected $table = 'contact_photo';

    protected $fillable = [
        'filename',
        'contact_id',
        'uploaded_data'
    ];
}
