@extends('layouts.app')
@section('content')
    <h1>Edit your info here</h1>
    <div style="background-color: white;" class="container pt-3">
        <form method="post" action="">
            @csrf
            @foreach ($users as $user)
                <input class="form-control" type="text" value="{{ $user->name }}" name="name">
                <input class="form-control mt-2" type="text" name="email" value="{{ $user->email }}">
                {{-- <a href="" class="btn btn-danger w-25 mt-2 mb-3">Change password</a> --}}
            @endforeach
            <br>
            <input type="submit" class="btn btn-primary w-25 mb-3" value="Submit">
        </form>
    </div>
@endsection
