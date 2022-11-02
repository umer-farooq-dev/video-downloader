<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advanced extends Model
{
    use HasFactory;

    protected $table = 'advanceds';
    protected $guarded = [];
    protected $casts = [
        'header_status' => 'boolean',
        'footer_status' => 'boolean',
    ];
}
