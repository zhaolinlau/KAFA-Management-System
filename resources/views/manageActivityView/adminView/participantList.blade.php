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
    <title>Document</title>
</head>

<body>
    <div>

        @if (session('status'))
            <div class="alert alert-danger">
                {{session('status')}}
            </div>  
        @endif

        <h2>Participant List</h2>
        <div>
            <form action="{{ route('searchParticipant') }}" method="GET">
                <input type="text" name="search" class="form-control" placeholder="Enter Student Name" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div>
            <a href="{{route('displayRegistration')}}">
                <button class="btn btn-outline-secondary">Pending</button>
            </a>
            <a href="{{route('displayParticipant')}}">
                <button class="btn btn-secondary">Registered</button>
            </a>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Date</th>
                        <th scope="col">Student's Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activityParticipants as $participant)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $participant->activity->activityName }}</td>
                            <td>{{ $participant->activity->activityDate }}</td>
                            <td>{{ $participant->student->student_name }}</td>
                            
                            <td>
                                <a href="{{ route('deleteParticipant', ['participantId' => $participant->participantId]) }}">
                                    <button class="btn btn-danger">Delete</button>
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
