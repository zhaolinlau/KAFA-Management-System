<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Registration List</title>
</head>

<body>

    @if (session('status'))
        <div class="alert alert-success">
             {{session('status')}}
        </div>
    @elseif (session('destroy'))
        <div class="alert alert-danger">
            {{session('destroy')}}
        </div>
    @endif

    <div>
        <h2>Application List</h2>
        <div>
            <form action="{{ route('searchRegistration') }}" method="GET">
                <input type="text" name="search" class="form-control" placeholder="Enter Student Name" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div>
            <a href="{{route('displayRegistration')}}">
                <button class="btn btn-secondary">Pending</button>
            </a>
            {{-- {{route('displayParticipant')}} --}}
            <a href="{{route('displayParticipant')}}">
                <button class="btn btn-outline-secondary">Registered</button>
            </a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Activity Name</th>
                        <th scope="col">Activity Date</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Students IC</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityParticipants as $participant)
                        <tr>
                            <td>{{ $participant->activity->activityName }}</td>
                            <td>{{ $participant->activity->activityDate }}</td>
                            <td>{{ $participant->student->student_name }}</td>
                            <td>{{ $participant->student->student_ic }}</td>
                            <td>
                                <form action="{{ url('registration/' .$participant->participantId. '/approval' ) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="float: left;">Approve</button>
                                </form>
                                
                                <a href="{{url('registration/' .$participant->participantId. '/reject')}}">
                                    <button class="btn btn-danger">Reject</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
