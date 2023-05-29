<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'slug'];
    public function projects()
    {
        // one to many relationship, each type has many projects
        return $this->hasMany(Project::class);
    }
}
