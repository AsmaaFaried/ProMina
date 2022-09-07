@extends('layouts.app')
@section('page-title')
    Create Album
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card text-center w-75">
                <div class="card-header ">
                  Create New Album
                </div>
                <div class="card-body">
                 
                    <form method="POST" action="{{ route('albums.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right ">Title </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" placeholder="Enter album name">

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
                                    Create Album
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
