@extends('layouts.app')
@section('content')
    <h1 class="text-center  my-5 py-3">View {{$album->name}} Media </h1>
    <div class="text-center">
        <a href="{{route('album.index')}}">
            <button type="button" class="btn btn-dark">Back To Albums</button>
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
                        <th scope="col">Media</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($images  as  $image)

                        <tr>
                            <td>
                                {{$image->id}}
                            </td>
                            <td>
                                <img src="{{ $image->getUrl('preview') }}" alt="{{ $image->getUrl('preview') }}">
                            <td>
                                <button id="delete" data-media_id="{{$image->id}}" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    <div class="d-flex justify-content-center">
                        {!! $images->links() !!}
                    </div>
            </div>
        </div>
    </div>




    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confirmation!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" method="post">
                        @csrf
                        <input id="id" name="id" hidden>
                        <h5 class="text-center">Are you sure you want to delete this Picture?</h5>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="delete-media"  data-url="{{isset($image) ? route('album.media.delete', $image->id) :'' }}" type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    @push('scripts')
        <script>
            $(document).on('click','#delete',function(){
                let id = $(this).attr('data-media_id');
                $('#id').val(id);
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
            $('body').on('click', '#delete-media', function () {
                var route = $(this).data("url");
                var media_id  = $('#id').val();
                var album_id  = {{$album->id}};
                $.ajax({
                    method: 'delete',
                    url: route,
                    data: {
                        album_id : album_id,
                        media_id : media_id
                    },
                    success: function() {
                    },
                    error: function() {
                        console.log('error')
                    }
                });
            });
        </script>
    @endpush
@endsection

