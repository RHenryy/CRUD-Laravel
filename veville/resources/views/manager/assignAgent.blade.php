@extends('layouts.app')
@section('content')
    <div class="container">
        <form class="form-group">
            @csrf
            <select class="form-control w-75 m-auto" name="assignAgent" id="">
                <option hidden value="">Choisissez l'agent à assigner</option>
                @foreach ($agents as $agent)
                    <option value="{{ $agent->id_user }}">{{ $agent->name }}</option>
                @endforeach
            </select>
            <select class="form-control w-75 m-auto mt-2" name="assignLocation" id="">
                <option hidden value="">Choisissez la location à assigner</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id_location }}">{{ $location->title_location }}</option>
                @endforeach
            </select>
        </form>
    </div>
@endsection
