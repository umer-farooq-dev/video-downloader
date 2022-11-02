<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    use HasFactory;
    protected $table = 'languages';
    protected $guarded = [];

    public function translations() {
        return $this->hasMany(Translations::class);
    }
    protected $casts = [
        'default' => 'boolean',
    ];
}
