@extends('layouts.app')
@section('page-title')
  List all Albums
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
             {{--  <!-- Modal -->  --}}
             <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteModalLabel">Delete Album</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                <form method="POST" action="{{ route('albums.delete')}}">
                        @csrf
                    <div class="modal-body">
                        <input type="hidden" name="album_delete_id" id="album_id"/>
                      If you press remove the album will be deleted with all pictures , Are you sure to delete this album completely ?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Remove</button>
                       
                        <a href="#" class="btn btn-primary">Move Pictures</a>

                        
                    </div>
                </form>
                  </div>
                </div>
              </div>
            </div>


            <div class="card text-center">

                <div class="card-body">

                  <a href="{{route('albums.create')}}" class="btn btn-success">Create New Album</a>
                </div>
            </div>
            
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            <br>
            <div class="card text-center">

                <div class="card-header">
                    All Albums
                </div>
                <div class="card-body">
                    @if ($albums->count() >0)
                    <ul class="list-group">
                        @foreach($albums as $album)
                            <li class="list-group-item mb-2 ">
                            {{ $album->name }}
                            
                            <button class="btn  btn-outline-danger show-album delAlbum" value="{{$album->id}}" data-toggle="modal" data-target="#deleteModal">Delete</button>
                            <a href="{{ route('albums.show',['album'=>$album]) }}" class="btn btn-outline-info show-album ">View Album</a>
                            <a href="{{ route('albums.edit',['album'=>$album]) }}" class="btn btn-outline-info show-album ">Edit</a>
                            </li>
                            
                            
                        @endforeach
                    </ul>

                    @else
                    <h5 class="text-center text-warning">There is no albums</h5>
                    @endif

                </div>
            </div>



        </div>
    </div>
</div>
@endsection

@push('page_scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delAlbum').click(function(e){
                e.preventDefault();
                var album_id=$(this).val();
                $('#album_id').val(album_id);
                $('#deleteModal').modal('show');
            })
        })
    </script>
@endpush