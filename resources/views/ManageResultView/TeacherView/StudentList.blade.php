@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2>List of Students</h2>
    <form method="GET" action="{{ route('results.index') }}">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search by Name or Matric Id" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Matric Id</th>
                <th>Name</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->matric_no }}</td>
                    <td>{{ $student->student_name }}</td>
                    <td>
                        @php
                            $finished = $student->results->count() > 0; // Adjust this logic as needed
                        @endphp
                        @if ($finished)
                            <a href="{{ route('teacher.showSubject', $student->id) }}" class="text-success">Finished</a>
                        @else
                            <a href="{{ route('teacher.showSubject', $student->id) }}" class="text-danger">Unfinished</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
