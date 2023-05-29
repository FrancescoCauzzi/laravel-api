<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'slug', 'website'];

    public function projects()
    {
        // Many-to-Many relationship between projects and technologies
        // The pivot table is called project_technology
        // each technology can be used in multiple projects (Project entity here)
        return $this->belongsToMany(Project::class);
    }
}
