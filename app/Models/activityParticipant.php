<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activityParticipant extends Model
{
    use HasFactory;

    protected $table = 'activity_participants';
    protected $primaryKey = 'participantId'; 

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentsId');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activityId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usersId');
    }
}

