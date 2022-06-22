@extends('layouts.app')

@section('content')
    <h1>Edit appartments' information</h1>
    <form class="w-25 container" method="POST" action="" enctype="multipart/form-data">
        @csrf
        <label for="title">Appartment name:</label><br>
        <input class="form-control" type="text" name="title_location" value="{{ $locations[0]->title_location }}"
            placeholder="appartment name"><br>
        <label for="v_agency">Agency:</label>
        <select class="form-select" name="id_agency" id="v_agency">
            <option hidden value="">Choose your agency</option>
            <option hidden selected value="{{ $agency[0]->id_agency }}">{{ $agency[0]->title_agency }} -
                {{ $agency[0]->city }}</option>
            @foreach ($agencies as $agency)
                <option value="{{ $agency->id_agency }}">{{ $agency->title_agency }} - {{ $agency->city }}
                </option>
            @endforeach
        </select>
        <label for="price">Rent Price:</label><br>
        <input class="form-control" type="text" value="{{ $locations[0]->rent_price }}" name="rent_price"
            placeholder="rent price"><br>
        <label for="description">Description</label><br>

        <textarea class="form-control" name="description"
            placeholder="Appartment Description">{{ $locations[0]->description }}</textarea><br>
        @if (isset($locations[0]->photo))
            <div>
                <span>Current Photo</span><br />
                <img src="{{ asset('storage/' . $locations[0]->photo) }}" alt="{{ $locations[0]->title_location }}">
            </div>
        @endif
        <label for="photo">Photo:</label><br>
        <input class="form-control" type="file" name="photo" placeholder="photo"><br>
        <button type="submit" class=" mb-3 w-100 btn btn-primary">Submit</button>
    </form>
@endsection
