<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionImage extends Model
{
    use HasFactory;
    protected $guarded=['id'];


    public function section()
    {
        return $this->belongsTo(ProjectSection::class, 'section_id'); // Correct foreign key column
    }
}
