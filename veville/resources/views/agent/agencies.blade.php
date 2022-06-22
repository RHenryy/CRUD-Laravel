@extends('layouts.app')

@section('content')
    <h1>Votre agence</h1>


    <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2>
    <div class="container">
        <div class="flexAnnonces">
            @foreach ($agencies as $agency)
                <div style="width:45%;" class="cardBackgroundColor pt-5 mb-5 m-3">
                    <img class="rounded d-block mx-auto mb-2" style="width:80%;border:3px solid black"
                        src="{{ Storage::url($agency->photo) }}">
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->title_agency }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->city }} - {{ $agency->pc }} -
                            {{ $agency->address }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->description }} </strong></p>
                    <div class="text-center">
                        <a href="/agencies/show/{{ $agency->id_agency }}"
                            class="text-center mb-4 btn btn-primary btn-block p-3">Nous contacter</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
