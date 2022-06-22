@extends('layouts.app')

@section('content')
    <div class="product">

        <p> {{ $locations[0]->title_location }} - Loyer de {{ $locations[0]->rent_price }}€ tcc </p>



        <div id="myCarousel" class="carousel slide carouselContainer mb-3 mt-5" data-bs-ride="carousel"
            data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('storage/' . $locations[0]->photo) }}"
                        alt="{{ $locations[0]->title_location }}">
                </div>

                @foreach ($images as $image)
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('storage/' . $image->src) }}"
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
        <div style="text-align:center">
            <a href="/contact/{{ $locations[0]->id_location }}" style="width:20%;padding:1rem;"
                class="btn btn-primary">Prenez rendez-vous maintenant !</a>
        </div>
    @endsection
