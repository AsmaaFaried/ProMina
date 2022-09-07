@extends('layouts.app')
@section('page-title')
    Edit Album
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card text-center w-75">
                <div class="card-header ">
                  Update Album
                </div>
                <div class="card-body">
                 
                    <form  action="{{ route('albums.update',['album'=>$album]) }}" method="POST">
                        @csrf
                        @method('PUT')


                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right ">Title </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " value="{{ $album->name }}" name="name" placeholder="Enter album name">

                                @error('name')
                                <div class="alert alert-danger mt-2" role="alert">
                                    
                                        
                                    {{ $message }}
                                    
                                </div>
                                @enderror
                            </div>
                        </div>

                        
                       
                        <div class="row mb-3 ">
                            <div class="col-md">
                                <a href="{{ route('albums.index') }}" class="btn btn-danger">Back</a>

                                <button type="submit" class="btn btn-primary">
                                    Update Album
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
              </div>
        </div>
        
    </div>
</div>
@endsection
