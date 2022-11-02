<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translations extends Model
{
    use HasFactory;
    protected $table = 'translations';
    protected $guarded = [];

    public function languages() {
        return $this->belongsTo(Languages::class, 'lang_id');
    }
}
