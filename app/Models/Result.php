<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'Subject_name',
        'Marks',
        'Categories',
        'Grade'
    ];

    /**
     * Get the student that owns the result.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'id');
    }

    protected $casts = [
        'assessments' => 'array',
    ];
}
