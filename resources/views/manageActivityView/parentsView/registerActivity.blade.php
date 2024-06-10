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
    <title>Activity Registration</title>
</head>

<body>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {{-- Table of Student's Information --}}

    {{-- <table class="table table-bordered">
    <tbody>
      <tr>
        <th scope="row">Student Name</th>
        <td>{{$student->student_name}}</td>
      </tr>
      <tr>
        <th scope="row">Address</th>
        <td>{{$student->permanent_address}}</td>
      </tr>
      <tr>
        <th scope="row">IC</th>
        <td>{{$student->student_ic}}</td>
      </tr>
    </tbody>
  </table> --}}

    <br><br><br>

    {{-- Table of Available Activity to register --}}
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Activity Name</th>
                <th scope="col">Location</th>
                <th scope="col">Date</th>
                <th scope="col">Capacity</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activity_data as $activity)
                    <tr>
                        <th scope="row">{{ $activity->activityName }}</th>
                        <td>{{ $activity->activityLocation }}</td>
                        <td>{{ $activity->activityDate }}</td>
                        <td>{{ $activity->activityCapacity }}</td>
                        <td>
                            @php
                                $participant = $activity->activityParticipants->firstWhere('usersId', Auth::id());
                            @endphp

                            @if ($participant && $participant->status == 'Pending')
                                <h5><span class="badge bg-secondary">Pending</span></h5>
                            @else
                                <form action="{{ url('registerParticipant/' . $activity->activityId . '/register') }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </form>
                            @endif
                        </td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
