@extends('layouts.app')
@section('content')
    <div class="container mt-3">
        <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />
    </div>
    <div class="container">
        <h1 class="text-center mb-0">Vos rendez-vous</h1>

        <div class="flexAnnonces">

            @if ($messages->isEmpty())
                <h3 class="mt-5" style="font-weight:bold;text-decoration:underline;">Pas de messages pour le moment</h3>
            @else
                @foreach ($messages as $message)
                    <div style="width:45%;" class="mt-3 messages pt-4">
                        <a href="/locations/show/{{ $message->id_location }}"><img class="mb-3"
                                style="width:95%;height:250px;" src="{{ asset('storage/' . $message->photo) }}"></a>
                        <p class="message"><span style="color:red;">Id de location: </span>{{ $message->id_location }}
                        </p>
                        <p class="message"><span style="color:red;">Nom de l'appartement:
                            </span>{{ $message->title_location }}
                        </p>
                        <p class="message"><span style="color:red;">Description: </span>{{ $message->description }}</p>
                        <p class="message"><span style="color:red;">Message: </span>{{ $message->message }}</p>
                        <p class="message"> <span style="color:red;">Envoyé par: </span>{{ $message->name }} -
                            {{ $message->email }}</p>
                        <p class="message"> <span style="color:red;">Message envoyé le:
                            </span>{{ $message->created_at }}
                        </p>
                        <div class="text-center">
                            <a href="mailto:{{ $message->email }}" class="btn btn-dark">Répondre</a>
                        </div>
                        <form style="width:100%;" class="text-center" method="post"
                            action="/agent/messages/archive/{{ $message->id_booking }}" class="group-form">
                            @csrf

                            <input type="submit" class="w-50 mt-2 btn btn-danger" value="Archiver Message">
                            @foreach ($messages as $message)
                                <input hidden name="agent_id" value="{{ $message->user_id }}">
                                <input hidden id="username" name="name" type="text" class="w-100 form-control"
                                    value="{{ $message->name }}"><br>
                                <input hidden id="emailUser" name="email" type="text" class="w-100 form-control"
                                    value="{{ $message->email }}"><br>
                                <textarea hidden id="messageUser" class="w-100 form-control" name="message" type="text" class="w-100 form-control">{{ $message->description }}</textarea>
                                <input type="text" hidden value="{{ $message->id_location }}" name="idLocation">
                                <input type="text" hidden value="{{ $message->id_agency }}" name="idAgency">
                                <input type="text" hidden value="{{ $message->created_at }}" name="createdAt">
                            @endforeach

                        </form>
                        {{-- <a href="/agent/messages/archive/{{ $message->id_booking }}"><button type="button" class="btn btn-danger w-25">Archiver Message</button></a> --}}

                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="container text-center mt-3">
        <a href="/agent/messages/archives/{{ Auth::user()->id }}"><button type="button"
                class="btn btn-primary w-25">Montrer les messages archivés</button></a>
    </div>
@endsection
