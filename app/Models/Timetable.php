<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    // Define the attributes that are mass assignable
    protected $fillable = ['class_name'];

    // Define a relationship to the TimetableEntry model
    public function entries()
    {
        return $this->hasMany(TimetableEntry::class);
    }
}
