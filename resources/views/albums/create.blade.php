@extends('layouts.app')
@section('content')
    <h1 class="text-center  mt-5 mb-2 py-3">Add New Product </h1>

    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <form class="p-5 border mb-5" method="POST" action="{{route('album.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" required name="name" class="form-control" id="name" >
                    </div>
                    <div class="form-group">
                        <label for="name">Images</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
                    <button type="submit" name="submit" class="btn btn-dark">Submit</button>
                </form>

            </div>
        </div>
    </div>
@endsection

