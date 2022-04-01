@extends('layouts.app')

@section('content')
    <form style="width: 30%;" class="container" action="" method="post">
        @csrf
        <label for="nickname">Nickname:</label><br>
        <input class="form-control" type="text" value="{{ $member[0]->nickname }}" name="nickname"
            placeholder="nickname"><br>
        <label for="password">Password</label><br>
        <input class="form-control" type="text" value="" name="password" placeholder="password"><br>
        <label for="name">Name</label><br>
        <input class="form-control" type="text" value="{{ $member[0]->lastname }}" name="lastname"
            placeholder="name"><br>
        <label for="firstname">First Name</label><br>"
        <input class="form-control" type="text" value="{{ $member[0]->firstname }}" name="firstname"
            placeholder="firstname"><br>
        <label for="mail">Email</label><br>
        <input class="form-control" type="text" value="{{ $member[0]->email }}" name="mail" placeholder="mail"><br>
        <label for="v_agency">Agency</label>
        <select class="form-select" name="civility" id="civility">
            <option hidden value="">What do you identify as</option>
            <option value="h">Homme</option>
            <option value="f">Femme</option>
            <option value="nb">Non-Binary</option>
        </select>
        <label for="status">Status</label>
        <select class="form-select" name="status" id="status">
            <option hidden value="">Choose your status</option>
            <option value="0">User</option>
            <option value="1">Editor</option>
            <option value="2">Admin</option>
        </select>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
