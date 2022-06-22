@extends('layouts.app')

@section('content')
    <div class="product">

        <p> {{ $locations[0]->title_location }} - Loyer de {{ $locations[0]->rent_price }}€ tcc </p>
        <div style="text-align:center">
            @if (!$contacts->isEmpty())
                <a id="showModal" style="width:20%;padding:0.5rem;" class="btn btn-dark">Prenez rendez-vous maintenant !</a>
            @else
                <h3 class="mt-4" style="font-weight:bold;text-decoration: underline;">L'appartement n'est pas/plus
                    disponible à la
                    location pour le moment</h3>
                <a href="/agencies/show/{{ $locations[0]->id_agency }}" class="btn btn-primary">Contactez l'agence pour plus
                    d'informations</a>
            @endif
        </div>



        <div id="myCarousel" class="carousel slide container mb-3 mt-5 w-50" data-bs-ride="carousel"
            data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img style="height:450;" class="d-block w-100" src="{{ asset('storage/' . $locations[0]->photo) }}"
                        alt="{{ $locations[0]->title_location }}">
                </div>

                @foreach ($images as $image)
                    <div class="carousel-item">
                        <img style="450px;" class="d-block w-100" src="{{ asset('storage/' . $image->src) }}"
                            alt="{{ $image->title_location }}">
                    </div>
                @endforeach
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            {{-- <p><img style="width:50%;" src="{{ asset('storage/' . $locations[0]->photo) }}"></p> --}}
        </div>
        <div id="backdrop" class="backdrop d-none" onclick="closeModal()">

        </div>
        <div class="container text-start mt-5">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias placeat animi soluta nihil voluptatibus
                necessitatibus cumque vero maxime asperiores, veniam omnis labore doloribus est, quam deserunt quas modi cum
                aperiam!
                Non molestias fugiat qui dolores aut! Ipsam molestiae repellendus quibusdam expedita dolorem repellat aut
                tempore, quis cum ex aliquam deserunt amet totam. Provident consequatur eum blanditiis a necessitatibus,
                corrupti facere!
                Ipsam eligendi ipsa ea quia eveniet quasi placeat molestiae doloribus eum illo, deserunt illum doloremque
                autem, sequi veniam quae nostrum. Iste, esse quae! Delectus, itaque iure? Delectus alias dignissimos
                aliquam.
                Maxime quis in quasi nihil ea harum laudantium voluptas veniam expedita distinctio. Tempora optio, unde
                perspiciatis eveniet quaerat commodi? Exercitationem possimus beatae velit consequatur alias officia optio
                excepturi explicabo adipisci.
                Mollitia perspiciatis vel consequuntur sequi labore a dolorem deserunt quod. A, sit iure quidem dolor vero
                commodi impedit officia nobis, quas aliquam doloribus ratione. Ratione sit rerum debitis dignissimos
                necessitatibus?</p>
        </div>
        @if (!$contacts->isEmpty())
            <div id="modal" class="modal">

                <h1 class="mb-3 mt-0"> Prenez rendez-vous avec un des agents en charge de l'annonce !</h1>

                <form method="post" action="/contact/" class="w-50 container ">
                    @csrf
                    <label for="agentLocation">Agent à contacter: </label>
                    <select class=" w-100 form-select mb-3" name="agent_id" id="agentLocation">
                        <option hidden>Choisissez un des agents listés ici</option>

                        @foreach ($contacts as $contact)
                            <option value="{{ $contact->id_user }}">{{ $contact->name }}</option>
                        @endforeach
                    </select>
                    <label for="username">Nom d'utilisateur: </label>
                    <input id="username" name="name" type="text" placeholder="Votre nom" class="form-control"
                        value="@if (Auth::check()) {{ Auth::user()->name }} @endif"><br>
                    <label for="emailUser">Votre e-mail: </label>
                    <input id="emailUser" name="email" type="text" placeholder="Votre email" class="form-control"
                        value="@if (Auth::check()) {{ Auth::user()->email }} @endif"><br>
                    <label for="messageUser">Votre message: </label>
                    <textarea id="messageUser" class="w-100 form-control" name="message" type="text" class="w-100 form-control">Bonjour, je serais intéressé par cet appartement. Cordialement.</textarea>
                    <div class="text-center">
                        <input type="submit" class="w-50 mt-4 btn btn-primary" value="Envoyer">
                    </div>
                    <input type="text" hidden value="{{ $contact->id_location }}" name="idLocation">
                    <input type="text" hidden value="{{ $contact->id_agency }}" name="idAgency">
                </form>
            </div>
        @else
        @endif
    @endsection
