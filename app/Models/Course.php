<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'user_id', 'slug', 'thumbnail'];

    public function author()
    {
        return $this->belongsTo(User::class); // A course belongs to one author (user)
    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class)->withTimestamps(); // A course can have many enrolled users
    }
}
