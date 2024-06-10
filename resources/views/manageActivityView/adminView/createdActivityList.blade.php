<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Activity List</title>
</head>

<body>


    <div id="main">
        {{-- Display Alert --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('destroy'))
            <div class="alert alert-danger" role="alert"">
                {{ session('destroy') }}
            </div>
        @endif
        <div>
            <div id="title">
                <h2>Activity List</h2>
            </div>
            <div>
                <a href="{{ url('createActivity') }}">
                    <button class="btn btn-dark">New Activity</button>
                </a>
            </div>
        </div>
        <div style="width: 800px" id="table">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Location</th>
                        <th scope="col">Cap</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- Display each activity data --}}
                    @foreach ($activity_data as $activity)
                        <tr>
                            <th scope="row">{{ $activity->activityId }}</th>
                            <td>{{ $activity->activityName }}</td>
                            <td>{{ $activity->activityLocation }}</td>
                            <td>{{ $activity->activityCapacity }}</td>
                            <td>{{ $activity->activityDate }}</td>
                            <td>
                                <a href="{{ url('createdActivity/' . $activity->activityId . '/edit') }}">
                                    <button class="btn btn-secondary">Edit</button>
                                </a>


                                <a href="{{ url('createdActivity/' . $activity->activityId . '/delete') }}">
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


{{-- CSS createdActivityList --}}
<style>
    #main {
        margin: auto;
        margin-top: 100px;

        width: 1000px;
        background-color: grey;
    }

    #title {
        float: left;
        margin-right: 380px;
        margin-left: 65px;
        margin-left: 0px;
    }

    #table {
        padding-left: 10px;
        padding-bottom: 10px;
        border-radius: 10px;
        width: 1000px;
    }
</style>
