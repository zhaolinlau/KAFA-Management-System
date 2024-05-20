@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row mt-3">
			<h1 class="text-center">Registration Form</h1>
			@if (Route::is('students.create'))
				<div class="col mt-3">
					<form class="row rounded-3 shadow-sm bg-white p-md-5 p-3" action="{{ route('students.store') }}" method="post"
						enctype="multipart/form-data">
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_ic_no">Parent IC Number</label>
							<input class="form-control" type="text" name="parent_ic_no" id="parent_ic_no">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_ic">Parent IC</label>
							<input class="form-control" type="file" name="parent_ic" id="parent_ic">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="parent_contact">Parent Contact</label>
							<input class="form-control" type="tel" name="parent_contact" id="parent_contact">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="relationship">Relationship</label>
							<select class="form-control" name="relationship" id="relationship">
								<option value="" selected></option>
								<option value="Father">Father</option>
								<option value="Mother">Mother</option>
								<option value="Guardian">Guardian</option>
							</select>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_name">Student Name</label>
							<input class="form-control" type="text" name="student_name" id="student_name">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="birthday">Student Birthday</label>
							<input class="form-control" type="text" name="birthday" id="birthday">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="birthplace">Student Birthplace</label>
							<input class="form-control" type="text" name="birthplace" id="birthplace">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="permanent_address">Permanent Address</label>
							<textarea class="form-control" name="permanent_address" id="permanent_address"></textarea>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_ic_no">Student IC Number</label>
							<input class="form-control" type="text" name="student_ic_no" id="student_ic_no"></input>
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_ic">Student IC</label>
							<input class="form-control" type="file" name="student_ic" id="student_ic">
						</div>
						<div class="col-md-6 mb-3">
							<label class="form-label" for="student_birthcert">Student Birth Certificate</label>
							<input class="form-control" type="file" name="student_birthcert" id="student_birthcert">
						</div>
						<div class="col mt-3">
							<button class="btn btn-primary" type="submit">Submit</button>
							<a class="btn btn-danger" href="{{ route('students.index') }}">Cancel</a>
						</div>
					</form>
				</div>
			@endif
		</div>
	</div>
@endsection
