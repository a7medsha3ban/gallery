@extends('layouts.app')
@section('content')
    <h1 class="text-center  mt-5 mb-2 py-3">Edit Album </h1>

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <form class="p-5 border mb-5" method="POST" action="{{route('album.update',$album->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" required value="{{old('name')?old('name'):$album->name}}" name="name" class="form-control" id="name" >
                    </div>
                    <div class="form-group">
                        <label for="name">Images</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection

