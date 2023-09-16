@extends('layouts.app')
@section('content')
    <h1 class="text-center  my-5 py-3">View All Albums </h1>
    <div class="text-center">
        <a href="{{route('album.create')}}">
            <button type="button" class="btn btn-dark">Create Album</button>
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto p-4 border mb-5">
                @if($success =  Session::get('success'))
                    <h3 class="alert alert-success text-center">{{$success}}</h3>
                @endif
                @if($error = Session::get('error'))
                    <h3 class="alert alert-danger text-center">{{$error}}</h3>
                @endif
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Media</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($albums  as  $album)
                        <tr>
                            <td>{{$album->id}}</td>
                            <td>{{$album->name}}</td>
                            <td>
                                <a href="{{route('album.media.show',$album)}}" class="btn btn-info" >Show Media</a>
                            </td>
                            <td>
                                <a href="{{route('album.edit',$album)}}" class="btn btn-info" >Edit</a>
                                @if(count($album->getMedia('images')) > 0)
                                    <button id="delete" data-current_id="{{$album->id}}" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal1">Delete</button>
                                @else
                                    <button id="delete" data-current_id="{{$album->id}}" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <input id="album_id" name="album_id" hidden>
    </div>




    <!-- Modal 1 -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel1">Delete Confirmation!</h1>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <h5 class="text-center">Are you sure you want to delete this Album?</h5>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#modal3">Move Pictures To Another Album</button>
                            <button data-url="{{isset($album) ? route('album.delete', $album->id) :'' }}" id="delete-album" type="button" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 1 -->

    <!-- Modal 2 -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel2">Delete Confirmation!</h1>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" method="post">
                        @csrf
                        <h5 class="text-center">Are you sure you want to delete this Album?</h5>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button  data-url="{{isset($album) ? route('album.delete', $album->id) :'' }}" id="delete-album" type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 2 -->


    <!-- Modal 3 -->

    <div id="modal3" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Choose An Album To Move Pictures</h5>
                    <form action="javascript:void(0)" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="albums_list">Album</label>
                            <select class="form-control" name="albums_list" id="albums_list">
                                @foreach($albums as $album)
                                    <option value="{{$album->id}}" {{ old('albums_list') == $album->id ? 'selected' : '' }}>{{$album->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button data-url="{{isset($album) ? route('album.media.move', $album->id) :'' }}" id="move-media" type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 3 -->




    @push('scripts')

        <script>
            $(document).on('click','#delete',function(){
                let id = $(this).attr('data-current_id');
                $('#album_id').val(id);
            });
        </script>
        <script type="text/javascript">
            //Passing Header Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            //Deleteing Album
            $('body').on('click', '#delete-album', function () {
                var route = $(this).data("url");
                $.ajax({
                    method: 'delete',
                    url: route,
                    data: {
                        id: {{isset($album) ? $album->id :'' }}
                    },
                    success: function(data) {

                        },
                    error: function() {

                    }
                });
            });

            //Moving Media and Deleting Album
            $('body').on('click', '#move-media', function () {
                var route = $(this).data("url");
                var new_album_id  = $('#albums_list').val();
                $.ajax({
                    method: 'delete',
                    url: route,
                    data: {
                        old_album_id: $('#album_id').val(),
                        new_album_id: new_album_id
                    },
                    success: function(data) {
                        console.log(data)
                    },
                    error: function(e) {
                        alert('hi')
                    }
                });
            });

        </script>
    @endpush
@endsection

