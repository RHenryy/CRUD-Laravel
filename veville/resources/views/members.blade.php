@extends('layouts.app')
@section('content')
    <h1>Nos agents à votre disposition!</h1> <br />

    <h2 style="color:green;font-weight:bold;">{{ session('msg') }}</h2><br />

    <table class="agency center">
        <tr>
            <th>Nickname</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>email</th>
            <th>civility</th>
            <th>session_status</th>
            <th>register_date</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td> {{ $user->name }} </td>
                <td> {{ $user->email }}</td>
                <td> {{ $user->password }}</td>

                <td> <a href="/members/delete/{{ $user->id }}">
                        <i class="fa-solid fa-2x fa-trash"></i></a> -

                    <a href="/members/edit/{{ $user->id }}">
                        <i class="fa-solid fa-2x fa-pen-fancy"></i>
                    </a>
                </td>

            </tr>
        @endforeach
        {{-- </table><br />

    <form class="container w-50" action="/members" method="post">
        @csrf
        <label for="nickname">Nickname:</label><br>
        <input class="form-control" type="text" name="nickname" placeholder="nickname"><br>
        <label for="password">Password</label><br>
        <input class="form-control" type="text" name="password" placeholder="password"><br>
        <label for="name">Name</label><br>
        <input class="form-control" type="text" name="name" placeholder="name"><br>
        <label for="firstname">First Name</label><br>
        <input class="form-control" type="text" name="firstname" placeholder="firstname"><br>
        <label for="mail">Email</label><br>
        <input class="form-control" type="text" name="mail" placeholder="mail"><br>
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
        </select><br />

        <button type="submit" class=" w-100 btn btn-primary">Submit</button>

    </form> --}}
    @endsection
