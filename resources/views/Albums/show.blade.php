@extends('layouts.app')
@section('page-title')
    Album details
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 ">

            <div class="card text-center w-75">
                <div class="card-header ">
                  {{ $album->name }}
                </div>
                
                <div class="card-body ">

                    <div class="row mb-3">

                        <div class="col-md">
                            <form method="POST" action="{{ route('albums.upload', $album->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <h4>
                                        This album contains {{ $pictures }} Picture{{ ($pictures > 1) ? 's' : '' }}
                                    </h4>
                                    <label for="formFileMultiple" class="form-label">Upload Pictures here</label>
                                    <input class="form-control" type="file" id="formFileMultiple" name="image" multiple>
                                    </div>
                                <div class="sm:col-span-6 pt-5">
                                    <button class="btn btn-success">Upload</button>
                                </div>
                                </form>
                                <br>
                                <a href="{{ route('albums.index') }}" class="btn btn-danger">Back</a>

                        </div>
                    </div>      
                </div>  
              </div>

              
        </div>
        
    </div>
</div>
@endsection
