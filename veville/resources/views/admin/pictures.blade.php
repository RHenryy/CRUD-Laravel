@extends('layouts.app')
@section('content')

<h1>Upload more pictures here</h1>

<div class="container text-center">
    <h2 style="color:green" class="text-center mb-3"><strong>{{ session('msg') }}</strong></h2>
    <p class="h4 mb-3">Current appartment : {{ $locations[0]->title_location }} - {{ $locations[0]->city }}</p>
<img src="{{ asset('storage/' . $locations[0]->photo) }}" alt="{{$locations[0]->title_location}}">
<form class="mt-4" method="post" action="/admin/pictures/{{ $locations[0]->id_location }}" enctype="multipart/form-data">
    @csrf
    <input class="form-control" type="file" name="photo" placeholder="Add a picture" />
    <input type="submit" class="w-25 mt-3 btn btn-primary" value="Submit">
</form>
</div>
<div class="container text-left align-middle mw-25 mt-4">
    @foreach($images as $image)
    <ul class="pictureList">
        <li class="mb-3">
    <img style="max-width:25%;" src="{{ asset('storage/'. $image->src) }}"><a href="/admin/pictures/delete/{{ $locations[0]->id_location }}/{{ $image->id }}">---
        <i class="fa-solid fa-2x fa-trash"></i></a>
    </li>
    @endforeach
</div>
@endsection