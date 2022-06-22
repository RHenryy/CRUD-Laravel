@extends('layouts.app')

@section('content')
    <h1> Edit User info</h1>
    <form style="width: 30%;" class="container" action="" method="post">
        @csrf
        <label for="nickname">User Name:</label><br>
        <input class="form-control" type="text" value="{{ $member[0]->name }}" name="name" placeholder="name"><br>

        <label for="mail">Email</label><br>
        <input class="form-control" type="text" value="{{ $member[0]->email }}" name="email" placeholder="mail"><br>
        <label for="v_agency">Agency</label>

        <label for="status">Status</label>
        <select class="form-select" name="status" id="status">
            <option hidden value="">Choose your status</option>
            <option hidden selected value="{{ $member[0]->role }}">{{ $member[0]->role }}</option>
            <option value="0">User</option>
            <option value="1">Admin</option>
            <option value="2">Agent</option>
            <option value="3">Manager</option>
        </select>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
