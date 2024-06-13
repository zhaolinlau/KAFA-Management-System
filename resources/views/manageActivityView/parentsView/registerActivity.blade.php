@extends('layouts.app')

@section('content')

    <div id="main">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <h1 id="title">Activity Registration</h1>
        <div style="float: right;">
            <a href="{{ route('displayActivity') }}">
                <button class="btn btn-secondary">Registration</button>
            </a>
            <a href="{{ route('displayRegisteredActivity') }}">
                <button class="btn btn-outline-secondary">Participate</button>
            </a>
        </div>

        {{-- Table of Available Activity to register --}}
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
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
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $activity->activityName }}</td>
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
    </div>

    <style>
        #main {
            margin: auto;
            width: 1200px;
        }

        #title {
            margin-bottom: 50px;
            margin-top: 20px;
            text-align: center;
        }
    </style>
@endsection
