@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Timetables</h2>
    <div class="mt-1 mb-2">
        <a href="{{ route('timetables.create') }}" class="btn btn-success">Add Timetable</a>
    </div>
    @if ($timetables->isEmpty())
        <p>No timetables found.</p>
    @else
        @foreach ($timetables as $timetable)
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Class: {{ $timetable->class_name }}</h4>
                </div>
                <div class="card-body">
                    @if ($timetable->entries->isEmpty())
                        <p>No entries found for this timetable.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Teacher</th>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timetable->entries as $entry)
                                    <tr>
                                        <td>{{ $entry->subject_name }}</td>
                                        <td>{{ $entry->teacher_name }}</td>
                                        <td>{{ $entry->day }}</td>
                                        <td>{{ $entry->start_time }}</td>
                                        <td>{{ $entry->end_time }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="mt-3">
                        <a href="{{ route('timetables.show', $timetable->id) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{ route('timetables.edit', $timetable->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                        <form action="{{ route('timetables.destroy', $timetable->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this timetable?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    
</div>
@endsection
