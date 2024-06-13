@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Check if there's a success message in the session and display it -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert" id="success-alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Check if there's an error message in the session and display it -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert" id="error-alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-md-8">
            <h2>Timetables</h2>
        </div>
        <!-- Place the "Create" button to go to create page -->
        <div class="col-md-4 text-md-end">
            <a href="{{ route('timetables.create') }}" class="btn btn-success">Create</a>
        </div>
    </div>
    @if (auth()->user()->role == 'admin')

    <!-- Display a message if there are no timetables -->
    @if ($timetables->isEmpty())
        <p>No timetables found.</p>
    @else
        {{-- Display the details of each timetable --}}
        @foreach ($timetables as $timetable)
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Class: {{ $timetable->class_name }}</h4>
                </div>
                <div class="card-body">
                    <!-- Display a message if there are no entries for the timetable -->
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
                                {{-- Display the list details of the each timetable --}}
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
                        <!-- Links to view, edit, and delete the timetable -->
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
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.getElementById('success-alert') || document.getElementById('error-alert');
        if (alert) {
            // Automatically hide the alert after 3 seconds
            setTimeout(() => {
                alert.classList.add('fade');
                // Remove the alert element from the DOM after it fades out
                setTimeout(() => {
                    alert.remove();
                }, 150);
            }, 3000);
        }
    });
</script>

{{-- CSS styling for alert page --}}
<style>
    .alert {
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1050;  
        width: 50%;
    }
</style>
@endsection
