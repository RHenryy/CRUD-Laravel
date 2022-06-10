@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2 style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2><br />
</div>
    @foreach ($messages as $message)
 
        <div class="container mt-5 messages">
            <img class="mb-3" style="max-width:40%" src="{{ asset('storage/' . $message->photo)}}">
            <p class="message"><span style="color:red;">Id de location: </span>{{ $message->id_location }}</p>
            <p class="message"><span style="color:red;">Nom de l'appartement: </span>{{ $message->title_location }}</p>
            <p class="message"><span style="color:red;">Description: </span>{{ $message->description }}</p>
            <p class="message"><span style="color:red;">Message: </span>{{ $message->message }}</p>
            <p class="message"> <span style="color:red;">Envoyé par: </span>{{ $message->name }} - {{ $message->email }}</p>
            <p class="message"> <span style="color:red;">Message envoyé le: </span>{{ $message->created_at }}</p>
            <form style="width: 100%;" method="post" action="/agent/messages/archive/{{ $message->id_booking}}" class="group-form">
                @csrf
        
              
           <input type="submit" class="w-25 mt-4 btn btn-danger" value="Archiver Message">
           @foreach($messages as $message)
                <input hidden name="agent_id" value="{{ $message->user_id }}">
                <input hidden id="username" name="name" type="text" class="w-100 form-control" value="{{ $message->name }}"><br>
                <input hidden id="emailUser" name="email" type="text" class="w-100 form-control" value="{{ $message->email }}"><br>
                <textarea hidden id="messageUser" class="w-100 form-control" name="message" type="text" class="w-100 form-control">{{ $message->description }}</textarea>
              
               
                
                <input type="text" hidden value="{{ $message->id_location}}" name="idLocation">
                <input type="text" hidden value="{{ $message->id_agency }}" name="idAgency">
            @endforeach
              
            </form>
            {{-- <a href="/agent/messages/archive/{{ $message->id_booking }}"><button type="button" class="btn btn-danger w-25">Archiver Message</button></a> --}}
   
        </div>
    @endforeach

    <div class="container">
        <a href="/agent/messages/archives/{{ Auth::user()->id }}"><button type="button" class="btn btn-primary w-25">Montrer les messages archivés</button></a>
    </div>


@endsection    
     

            

