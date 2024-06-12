@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row mt-3">
			<h1 class="text-center">Registration List</h1>
			<div class="col">
				@if (auth()->user()->role == 'admin')
					<div class="col-12 mt-3">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Name</th>
										<th scope="col">Status</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($students as $student)
										<tr>
											<th scope="row">{{ $loop->iteration }}</th>
											<td>{{ $student->student_name }}</td>
											<td>{{ $student->status }}</td>
											<td>
												<a class="btn btn-info" href="{{ route('students.show', $student) }}">View</a>
												<a class="btn btn-primary" href="{{ route('students.edit', $student) }}">Edit</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				@endif
			</div>
		</div>
	@endsection
