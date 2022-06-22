@extends('layouts.app')
@section('content')
<h2 class="mt-5" style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />
<div class="container mt-4 mb-5">

    @foreach($agents as $agent)
    
    <p>Agent's name: {{ $agent->name }}</p>
    <p>Agent's email: {{ $agent->email }}</p>
    <p>Location ID: {{ $agent->id_location }}</p>
    <p>Agency ID: {{ $agent->id_agency }}</p>
    --------------
    @endforeach
</div>
<div class="container">

    <form class="w-25" action="/admin/agents/store" method="post">
    @csrf
    
    <select class="form-select" name="id_location" id="id_location">
        <option value="" hidden>Select appartment to assign to agent</option>
        @foreach($locations as $location)
        <option value="{{ $location->id_location }}">{{$location->title_location }}</option>
        @endforeach
    </select>
        <select class="form-select" name="id_agency" id="id_agency">
            <option value="" hidden>Select agency to assign to agent</option>
            @foreach($agencies as $agency)
            <option value="{{ $agency->id_agency }}">{{$agency->title_agency }} - {{$agency->city}}</option>
            @endforeach
        </select>
    <select class="form-select" name="user_id">
        <option hidden value="">Select user id for agent</option>
        @foreach ($agents as $agent)
        <option value="{{ $agent->id_user }}">{{ $agent->name }}</option>
        @endforeach
    </select>
    <input type="submit" value="Submit Agent info" class="btn btn-primary w-50">
    </form>
</div>


@endsection