<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageImage extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function homepage()
    {
        return $this->belongsTo(Homepage::class);
    }
}
