<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimetableEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'timetable_id',
        'day',
        'subject_name',
        'teacher_name',
        'start_time',
        'end_time',
    ];

    public function timetable()
    {
        return $this->belongsTo(Timetable::class);
    }
}
