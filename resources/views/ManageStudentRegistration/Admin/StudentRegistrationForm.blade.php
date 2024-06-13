@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row mt-3">
			<h1 class="text-center">Registration Form</h1>
			@if (Route::is('students.show'))
				<div class="col">
					<form action="{{ route('students.update', $student) }}" class="row rounded-3 shadow-sm bg-white p-md-5 p-3"
						method="post">
						@csrf
						@method('put')
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_ic_no">Parent IC Number</label>
							<div>
								{{ $student->parent_ic_no }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_ic">Parent IC</label>
							<div>
								<a href="/storage/{{ $student->parent_ic }}" target="blank">{{ $student->parent_ic }}</a>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_contact">Parent Contact</label>
							{{ $student->parent_contact }}
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="relationship">Relationship</label>
							{{ $student->relationship }}
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_name">Student Name</label>
							<div>
								{{ $student->student_name }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="birthday">Student Birthday</label>
							<div>
								{{ $student->birthday }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="birthplace">Student Birthplace</label>
							<div>
								{{ $student->birthplace }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="permanent_address">Permanent Address</label>
							<div>
								{{ $student->permanent_address }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_ic_no">Student IC Number</label>
							<div>
								{{ $student->student_ic_no }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_ic">Student IC</label>
							<div>
								<a href="/storage/{{ $student->student_ic }}" target="blank">{{ $student->student_ic }}</a>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_birthcert">Student Birth Certificate</label>
							<div>
								<a href="/storage/{{ $student->student_birthcert }}" target="blank">{{ $student->student_birthcert }}</a>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="status">Registration Status</label>
							<div>
								{{ $student->status }}
							</div>
							@error('status')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="status">Matric Number</label>
							<div>
								{{ $student->matric_no }}
							</div>
							@error('matric_no')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-12 mt-3">
							<a class="btn btn-danger" href="{{ route('students.index', $student) }}">Back</a>
						</div>
					</form>
				</div>
			@elseif (Route::is('students.edit'))
				<div class="col">
					<form action="{{ route('students.update', $student) }}" class="row rounded-3 shadow-sm bg-white p-md-5 p-3"
						method="post">
						@csrf
						@method('put')
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_ic_no">Parent IC Number</label>
							<div>
								{{ $student->parent_ic_no }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_ic">Parent IC</label>
							<div>
								<a href="/storage/{{ $student->parent_ic }}" target="blank">{{ $student->parent_ic }}</a>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_contact">Parent Contact</label>
							{{ $student->parent_contact }}
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="relationship">Relationship</label>
							{{ $student->relationship }}
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_name">Student Name</label>
							<div>
								{{ $student->student_name }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="birthday">Student Birthday</label>
							<div>
								{{ $student->birthday }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="birthplace">Student Birthplace</label>
							<div>
								{{ $student->birthplace }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="permanent_address">Permanent Address</label>
							<div>
								{{ $student->permanent_address }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_ic_no">Student IC Number</label>
							<div>
								{{ $student->student_ic_no }}
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_ic">Student IC</label>
							<div>
								<a href="/storage/{{ $student->student_ic }}" target="blank">{{ $student->student_ic }}</a>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_birthcert">Student Birth Certificate</label>
							<div>
								<a href="/storage/{{ $student->student_birthcert }}" target="blank">{{ $student->student_birthcert }}</a>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="status">Registration Status</label>
							<select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
								<option value="{{ $student->status }}" selected>{{ $student->status }}</option>
								<option value="Pending">Pending</option>
								<option value="Approved">Approve</option>
								<option value="Rejected">Reject</option>
							</select>
							@error('status')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="status">Matric Number</label>
							<input type="text" name="matric_no" class="form-control @error('matric_no') is-invalid @enderror" value="{{ $student->matric_no }}">
							@error('matric_no')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="col-12 mt-3">
							<button class="btn btn-primary" type="submit">Save</button>
							<a class="btn btn-danger" href="{{ route('students.index', $student) }}">Back</a>
						</div>
					</form>
				</div>
			@endif

		</div>
	</div>
@endsection
