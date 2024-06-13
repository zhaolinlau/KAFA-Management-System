<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
	use HasFactory;

    public function activityParticipants()
    {
        return $this->hasMany(ActivityParticipant::class, 'studentsId');
    }
	public function results()
    {
        return $this->hasMany(Result::class, 'student_id');
    }
	protected $fillable = [
		'parent_ic_no',
		'parent_ic',
		'parent_contact',
		'relationship',
		'student_name',
		'birthday',
		'birthplace',
		'permanent_address',
		'student_ic_no',
		'student_ic',
		'student_birthcert',
		'status',
		'matric_no',
		'year',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
