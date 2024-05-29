<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class StudentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		if (auth()->user()->role == 'parent') {
			return view('ManageStudentRegistration.Parent.RegistrationList', ['students' => Student::with('user')->where('user_id', auth()->user()->id)->get()]);
		} elseif (auth()->user()->role == 'admin') {
			return view('ManageStudentRegistration.Admin.RegistrationList');
		}
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('ManageStudentRegistration.Parent.StudentRegistrationForm');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$request->validate([
			'parent_ic_no' => 'required|string',
			'parent_ic' => 'required|file|mimes:png,jpg,pdf',
			'parent_contact' => 'required|string',
			'relationship' => 'required|string',
			'student_name' => 'required|string',
			'birthday' => 'required|date',
			'birthplace' => 'required|string',
			'permanent_address' => 'required|string',
			'student_ic_no' => 'required|string',
			'student_ic' => 'required|file|mimes:png,jpg,pdf',
			'student_birthcert' => 'required|file|mimes:png,jpg,pdf',
		]);


		$request->user()->students()->create(array_merge($request->all(), [
			'parent_ic' => $request->file('parent_ic')->store($request->parent_ic_no, 'public'),
			'student_ic' => $request->file('student_ic')->store($request->student_ic_no, 'public'),
			'student_birthcert' => $request->file('student_birthcert')->store($request->student_ic_no, 'public'),
		]));

		return redirect(route('students.index'));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Student $student)
	{
		return view('ManageStudentRegistration.Parent.StudentRegistrationForm', ['student' => $student]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Student $student)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Student $student)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Student $student)
	{
		$student->delete();
		Storage::disk('public')->deleteDirectory($student->parent_ic_no);
		Storage::disk('public')->deleteDirectory($student->student_ic_no);
		return redirect(route('students.index'));
	}
}
