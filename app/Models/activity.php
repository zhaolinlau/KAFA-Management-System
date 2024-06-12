<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activity';
    protected $primaryKey = 'activityId';

    public function activityParticipants()
    {
        return $this->hasMany(ActivityParticipant::class, 'activityId');
    }
}
