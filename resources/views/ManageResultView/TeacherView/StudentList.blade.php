@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Students</h1>
    <form method="GET" action="{{ route('results.index') }}" class="form-inline mb-3">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search by name or matric number">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Matric Id</th>
                <th>Name</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->matric_no }}</td>
                    <td>{{ $student->student_name }}</td>
                    <td>
                        <a href="{{ route('results.showSubject', $student->id) }}" class="btn btn-link">
                            {{ $student->results->count() ? 'View Subjects' : 'No Subjects' }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
