@extends('layout')

@section('main')

<div class="container mt-3">
<div class="card text-center">
  <div class="card-header d-flex justify-content-between">
    <strong>Gallerry Item </strong>
    <a class="btn btn-outline-dark" href="{{route('gallery.index')}}">Back</a>
 </div>
  @session('error')
  <div class="alert alert-danger m-2" role="alert">
  {{$value}}
</div>
  @endsession
  @session('success')
  <div class="alert alert-success m-2" role="alert">
  {{$value}}
</div>
  @endsession
  <div class="card-body d-flex align-items-center justify-content-center">
    
    <div class="container" style="width: 350px;">
        <div class="row mt-2">
            <div class="col-6 d-flex">
                <strong>Name:</strong>
            </div>
            <div class="col-6 d-flex">{{$gallery->name}}</div>
        </div>
        <div class="row mt-2">
            <div class="col-6 d-flex">
                <strong>Description:</strong>
            </div>
            <div class="col-6 d-flex">{{$gallery->description}}</div>
        </div>
        <div class="row mt-2">
            <div class="col-6 d-flex">
                <strong>Gallery Image</strong>
            </div>
            <div class="col-6 d-flex" style="height: 150px; width:150px; object-fit:cover; overflow:hidden;margin:0px;
    padding: 0; border-radius: 5px;"><a href="{{asset('/gallery_image/'.$gallery->image)}}">
                <img style="height: 100%; width:100%;" src="{{asset('/gallery_image/'.$gallery->image)}}" alt=""></a></div>
        </div>
    </div>

</div>
   
</div>

@endsection