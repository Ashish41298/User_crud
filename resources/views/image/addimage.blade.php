@extends('layout')

@section('main')

<div class="container mt-3">
<div class="card text-center">
  <div class="card-header">
    Add New Image.
  </div>
  @session('error')
  <div class="alert alert-danger ms-2 me-2 mt-2" role="alert">
  {{$value}}
</div>
  @endsession
  @session('success')
  <div class="alert alert-success ms-2 me-2 mt-2" role="alert">
  {{$value}}
</div>
  @endsession
  <div class="card-body d-flex align-items-center justify-content-center">
  <div class="formbox" style="max-width: 350px; width:350px;">
    <form action="{{route('gallery.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label">Image Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter the image name">
            @error('name')
            <div class="form-text text-danger">
                {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Description</label>
            <textarea name="description" id="" cols="30" rows="2" class="form-control" placeholder="Enter the Description" ></textarea>
            @error('description')
            <div class="form-text text-danger">
                {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" placeholder="Select Image">
            @error('image')
            <div class="form-text text-danger">
                {{$message}}
              </div>
            @enderror
        </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-danger ms-2" href="{{route('gallery.index')}}">Cancel</a>
            </div>        
        </form>
    </div>
  </div>
</div>
   
</div>

@endsection