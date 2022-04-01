@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <form class="w-50 container" action="/locations" method="post" enctype="multipart/form-data">
            @csrf
            <label for="photo">Photo1</label><br>
            <input class="form-control" type="file" name="photo1" placeholder="photo"><br>

            <label for="photo">Photo2</label><br>
            <input class="form-control" type="file" name="photo2" placeholder="photo"><br>

            <label for="photo">Photo3</label><br>
            <input class="form-control" type="file" name="photo3" placeholder="photo"><br>

            <select class="form-select" name="v_agency" id="v_agency">
                <option hidden value="">Choose your agency</option>
                @foreach ($agencies as $agency)
                    <option value="{{ $agency->id_agency }}">{{ $agency->title_agency }} - {{ $agency->city }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="w-100 btn btn-primary">Submit</button>

        </form>
    </div>
@endsection
