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
    <title>Edit Activity</title>
</head>

<body>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Edit Form --}}
    <div style="width: 400px;">
        <!-- Edit activity form -->
        <form action="{{ url('createdActivity/' . $activity->activityId . '/update') }}" method="post">
            @csrf
            <input type="hidden" name="activityId" value="{{ $activity->activityId }}">
            <div>Activity : <input type="text" name="name" class="form-control" value="{{ $activity->activityName }}" style="color: grey"></div><br>
            <div>Location : <input type="text" name="location" class="form-control" value="{{ $activity->activityLocation }}" style="color: grey"></div><br>
            <div>Capacity : <input type="number" name="capacity" class="form-control" value="{{ $activity->activityCapacity }}" style="color: grey"></div><br>
            <div>Date : <input type="datetime-local" name="date" class="form-control" value="{{ $activity->activityDate }}" style="color: grey"></div><br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>
