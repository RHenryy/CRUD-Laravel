@extends('layouts.app')

@section('content')
    <form style="width: 25%;" class="container" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Agency name:</label><br>
        <input class="form-control" type="text" value="{{ $agencies[0]->title_agency }}" name="title_agency"
            placeholder="agency name"><br>
        <label for="address">address</label><br>
        <input class="form-control" type="text" value="{{ $agencies[0]->address }}" id="address" name="address"
            placeholder="address"><br>
        <label for="city">city</label><br>
        <input class="form-control" type="text" value="{{ $agencies[0]->city }}" name="city" placeholder="city"><br>
        <label for="pc">Postal code</label><br>
        <input class="form-control" type="text" value="{{ $agencies[0]->pc }}" name="pc" placeholder="pc"><br>
        @if (isset($agencies[0]->photo))
            <div>
                <span>Photo actuelle</span><br />
                <img src="{{ asset('storage/' . $agencies[0]->photo) }}" alt="kk">
            </div>
        @endif
        <label for="photo">Photo</label><br>
        <input class="form-control" type="file" value="{{ $agencies[0]->photo }}" name="photo" placeholder="photo"><br>
        <label for="description">Description</label><br>
        <textarea name="description" placeholder="Agency Description">{{ $agencies[0]->description }}</textarea><br>
        <button type="submit" name="action" value="add" class="btn btn-primary">Submit</button>

    </form>
@endsection
