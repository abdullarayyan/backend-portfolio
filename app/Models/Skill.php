<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $guarded=['id'];


    public function section()
    {
        return $this->belongsTo(SkillsSection::class, 'skills_section_id');
    }
}
