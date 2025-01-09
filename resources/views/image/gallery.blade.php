@extends('layout')

@section('main')

<div class="section " style=" width:100%; overflow:hidden;">
  <div class="container d-flex align-items-center justify-content-center flex-column">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" style="border-radius:10px; overflow:hidden; object-fit:cover; width:75%;">
      <!-- Carousel Indicators -->
      <div class="carousel-indicators">
          @if(count($galleries) > 0)
              @foreach ($galleries as $id => $gallery)
                  <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{$id}}" class="@if($loop->first) active @endif" aria-label="Slide {{$id + 1}}"></button>
              @endforeach
          @endif
      </div>
  
      <!-- Carousel Inner Wrapper -->
      <div class="carousel-inner">
          @foreach ($galleries as $id => $gallery)
              <div class="carousel-item @if($loop->first) active @endif" data-bs-interval="2000" style="height:500px; border-radius:10px;">
                  <img style="height: 100%; object-fit: cover;" src="{{asset('/gallery_image/'.$gallery->image)}}" class="d-block w-100 animate__animated animate__fadeIn" alt="...">
                  <div class="carousel-caption d-none d-md-block animate__animated animate__bounceIn">
                      <h5 class="animate__animated animate__fadeInDown">{{$gallery->name}}</h5>
                      <p class="animate__animated animate__fadeInUp">{{$gallery->description}}</p>
                  </div>
              </div>
          @endforeach
      </div>
  
      <!-- Carousel Controls -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1);"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1);"></span>
          <span class="visually-hidden">Next</span>
      </button>
  </div>
  
</div>

<div class="container mt-3">
<div class="card text-center mb-5">
  <div class="card-header d-flex align-items-center justify-content-between" style="background: rgb(231, 231, 231);">
    Image - Gallerry List.
    <a class="btn btn-outline-dark" href="{{route('gallery.create')}}"> Add new image</a>
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
  <div class="card-body">
  <div class="formbox">
    @if(count($galleries) > 0)
    <table class="table" style="width: 760px; margin:0 auto;">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">image</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($galleries as $key=>$gallery)
        <tr>
          <th scope="row">{{$key+1}}</th>
          <td>{{$gallery->name}}</td>
          <td>{{$gallery->description}}</td>
          <td style="height: 80px; width:80px; object-fit:cover; overflow:hidden;" class="p-0 m-0 rounded-3" ><img style="height: 100%; width:100%;" src="{{asset('/gallery_image/'.$gallery->image)}}" alt=""></td>
          <td>
            <a class="btn btn-outline-secondary" href="{{route('gallery.show', $gallery->id)}}">View</a>
            <a class="btn btn-outline-info" href="{{route('gallery.edit', $gallery->id)}}">Edit</a>
            <form action="{{route('gallery.destroy', $gallery->id)}}" method="POST" class="d-inline">
              @csrf 
              @method('DELETE')
              <input class="btn btn-outline-danger" type="submit" value="Delete" />
            </form>
          </td>
        </tr>
        @endforeach
      
      </tbody>
    </table>
    <div class="container">
      {{$galleries->links('pagination::bootstrap-5')}}
    </div>
    @else
      <div class="container">
        No Gallery image foud yet!
      </div>
    @endif
    </div>
  </div>
</div>
   
</div>


</div>

@endsection

<style>
  .carousel{
    position: relative;
  }
  .data-create{
    position: absolute;
    top:5px;
    right: 5px;
    z-index: 9999;
  }
  .carousel .carousel-control-prev, .carousel .carousel-control-next {
    height: 50px;
    width: 50px;
    margin: auto 10px;
    background: transparent;
    backdrop-filter: blur(10px);
    opacity: 1;
    border-radius: 10px;
    border: 1px solid rgb(255,255,255,0.3)
  }
  .carousel .carousel-control-next:hover .carousel-control-next-icon, .carousel .carousel-control-prev:hover .carousel-control-prev-icon{
    transform: scale(0.9);
  }
  .carousel-indicators{
    background: transparent;
    backdrop-filter: blur(10px);
    border-radius: 15px;
  }
  .carousel-caption{
    background: rgb(255,255,255,0.5);
    border-radius: 5px;
    position: absolute;
    top: 5px;
    left: 5px !important;
    height: fit-content;
    width: fit-content;
    padding: 0px 10px;
    transition: all 0.5s;
  }
  .carousel-caption:hover{
    background: white;
  }
</style>