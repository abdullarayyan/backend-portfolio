<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSection extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function images()
    {
        return $this->hasMany(SectionImage::class, 'section_id'); // Correct foreign key column
    }
}
