@extends('layouts.app')
@section('content')
    <div class="container mt-0">
        <h2 class="mb-3" style="color:green;font-weight:bold;text-align:center;">{{ session('msg') }}</h2>
        <h1 class="mb-0">Votre agence</h1>



        <div class="flexAnnonces">
            @foreach ($agencies as $agency)
                <div style="width:45%;" class="pt-5 mt-0 mb-5 m-3">
                    <a href="/agencies/show/{{ $agency->id_agency }}"><img class="rounded d-block mx-auto mb-2"
                            style="width:100%;border:3px solid black" src="{{ Storage::url($agency->photo) }}"></a>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->title_agency }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->city }} - {{ $agency->pc }} -
                            {{ $agency->address }}</strong></p>
                    <p class="text-center h4 mt-3 mb-3"><strong> {{ $agency->description }} </strong></p>
                    <div class="text-center">
                        <div class="flexAround">
                            <a href="/agencies/show/{{ $agency->id_agency }}"
                                class="w-25 text-center mb-4 btn btn-primary btn-block p-2"><i
                                    class="fa-solid fa fa-plus"></i></a>
                            <a id="showModal" class="w-25 text-center mb-4 btn btn-success btn-block p-2"><i
                                    class="fa-solid fa fa-pen-fancy"></i>

                            </a>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="backdrop" class="backdrop d-none" onclick="closeModal()"></div>
        <div class="modal" style="height:90%;" id="modal">
            <h1 class="mb-0 mt-0">Edit agency</h1>
            <form style="width: 90%;" class="container" action="/manager/agencies/edit/{{ $agencies[0]->id_agency }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <label for="name">Agency name:</label>
                <input class="form-control" type="text" value="{{ $agencies[0]->title_agency }}" name="title_agency"
                    placeholder="agency name">
                <label for="address">address</label>
                <input class="form-control" type="text" value="{{ $agencies[0]->address }}" id="address"
                    name="address" placeholder="address">
                <label for="city">city</label>
                <input class="form-control" type="text" value="{{ $agencies[0]->city }}" name="city"
                    placeholder="city">
                <label for="pc">Postal code</label>
                <input class="form-control" type="text" value="{{ $agencies[0]->pc }}" name="pc"
                    placeholder="pc">
                @if (isset($agencies[0]->photo))
                    <span>Photo actuelle :</span>
                    <div class="text-center">
                        <br /> <img src="{{ asset('storage/' . $agencies[0]->photo) }}" alt="immo">
                    </div>
                @endif
                <label for="photo">Photo</label>
                <input class="form-control" type="file" value="{{ $agencies[0]->photo }}" name="photo"
                    placeholder="photo">
                <label for="description">Description</label>
                <textarea name="description" placeholder="Agency Description">{{ $agencies[0]->description }}</textarea>
                <button type="submit" name="action" value="add" class="btn btn-primary">Submit</button>

            </form>
        </div>

    </div>
@endsection
