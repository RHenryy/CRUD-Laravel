@extends('layouts.app')

@section('content')
    <form style="width: 25%;" class="container" action="" method="post" enctype="multipart/form-data">
        @csrf
        <label for="name">Vehicle name:</label><br>
        <input class="form-control" type="text" value="{{ $vehicles[0]->title }}" name="title"
            placeholder="vehicle name"><br>
        <label for="brand">Brand</label><br>
        <input class="form-control" type="text" value="{{ $vehicles[0]->brand }}" name=" brand" placeholder="brand"><br>
        <label for="model">model</label><br>
        <input class="form-control" type="text" value="{{ $vehicles[0]->model }}" name=" model" placeholder="model"><br>
        <label for="v_agency">Agency</label>
        <select class="form-select" name=" v_agency" id="v_agency">
            <option hidden value="">Choose your agency</option>
            @foreach ($agencies as $agency)
                <option value="{{ $agency->id_agency }}">{{ $agency->title_agency }} - {{ $agency->city }}
                </option>
            @endforeach
        </select>
        <label for="price">Price</label><br>
        <input class="form-control" type="text" value="{{ $vehicles[0]->daily_price }}" name="daily_price"
            placeholder="price"><br>
        @if (isset($vehicles[0]->photo))
            <div>
                <span>Photo actuelle</span><br />
                <img src="{{ asset('storage/' . $vehicles[0]->photo) }}" alt="kk">
            </div>
        @endif
        <label for="photo">Photo</label><br>
        <input class="form-control" type="file" value="{{ $vehicles[0]->photo }}" name="photo" placeholder="photo"><br>
        <label for="description">Description</label><br>
        <textarea class="form-control" name="description"
            placeholder="Vehicle Description">{{ $vehicles[0]->description }}</textarea><br>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
