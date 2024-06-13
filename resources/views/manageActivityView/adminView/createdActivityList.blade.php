@extends('layouts.app')

@section('content')
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
        <div id="top">
            <div id="title">
                <h1>Activity List</h1>
            </div>
            <br>
            <div id="btn-new-activity">
                <a href="{{ url('createActivity') }}">
                    <button class="btn btn-dark">New Activity</button>
                </a>
            </div>
        </div>
        <div style="width: 800px" id="table">
            <table class="table" style="width: 1000px;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No.</th>
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
                            <th scope="row">{{ $loop->iteration  }}</th>
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



    {{-- CSS createdActivityList --}}
    <style>
        #main {
            margin: auto;
            /* margin-top: 100px; */
            width: 1000px;
        }

        #top{
            margin-bottom: 50px;
            margin-top: 20px;
        }

        #title {
            text-align: center;
            margin: auto;
        }

        #btn-new-activity{
            float: right;
        }


    </style>
@endsection
