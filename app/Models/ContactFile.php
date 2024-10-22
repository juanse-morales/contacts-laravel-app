<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFile extends Model
{
    use HasFactory;

    protected $table = 'contact_file';

    protected $fillable = [
        'original_filename',
        'new_filename',
        'contact_id'
    ];
}
