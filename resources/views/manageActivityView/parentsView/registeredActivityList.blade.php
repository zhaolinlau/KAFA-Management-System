@extends('layouts.app')

@section('content')
    <div id="main">
        <h1 id="title">Activity Registered</h1>
        <div style="float: right;">
            <a href="{{ route('displayActivity') }}">
                <button class="btn btn-outline-secondary">Registration</button>
            </a>
            <a href="{{ route('displayRegisteredActivity') }}">
                <button class="btn btn-secondary">Participate</button>
            </a>
        </div>

        {{-- table --}}
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Location</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($registered_data as $index => $participant)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th> <!-- Incremental number -->
                            <td>{{ $participant->activity->activityName }}</td>
                            <td>{{ $participant->activity->activityLocation }}</td>
                            <td>{{ $participant->activity->activityDate }}</td>
                            <td><span>Registered</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    <style>
        #main {
            margin: auto;
            width: 1000px;
        }

        #title {
            margin-bottom: 50px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
@endsection
