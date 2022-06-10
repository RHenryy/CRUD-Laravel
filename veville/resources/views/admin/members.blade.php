@extends('layouts.app')
@section('content')
    <h1>Manage members and privileges</h1> <br />

    <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />

    <table class="members center">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Email verified</th>
            <th>Register_date</th>
            <th>Role</th>
             <th>Actions</th>

        </tr>
    
        @foreach ($users as $user)
            <tr>
                <td> {{ $user->name }} </td>
                <td> {{ $user->email }}</td>
                @if($user->email_verified_at != null)
                <td> {{ $user->email_verified_at }}</td>
                @else <td> Not yet verified </td>
                @endif
                <td> {{ $user->created_at }}</td>
                <td> {{ $user->role }}</td>

                <td> <a href="/admin/members/delete/{{ $user->id }}">
                        <i class="fa-solid fa-2x fa-trash"></i></a> -

                    <a href="/admin/members/edit/{{ $user->id }}">
                        <i class="fa-solid fa-2x fa-pen-fancy"></i>
                    </a>
                </td>

            </tr>
        @endforeach
    </table><br />
@endsection

