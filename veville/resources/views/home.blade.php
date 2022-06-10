@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h2 class="alert-success text-center" role="alert">{{ session('editSuccess') }}</h2>

                        {{ __('You are logged in!') }} - {{ Auth::user()->name }}
                     
                    </div>
                    <div class="container">
                        @foreach ($users as $user)
                        
                            <p>Your username: <span style="color:red;">{{ $user->name }}</span></p>
                            <p>Your email: <span style="color:red;">{{ $user->email }}</span></p>
                            <p> CheckRole: <span style="color:red;">{{ $user->role }}</span></p>
                            <p> User id: <span style="color:red;">{{ $user->id }}</span></p>
                        @endforeach
                        <a href="home/edit/{{ Auth::user()->id}}" class=" mb-3 btn btn-primary w-25">Edit info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
