@extends('layout')

@section('main')

<div class="container mt-3">
<div class="card text-center">
  <div class="card-header d-flex justify-content-between">
    <strong>Welcome! <i style="font-weight:normal;">{{$cuser->name}}</i> </strong>
    <strong>Dashboard</strong>
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
            <div class="col-6 d-flex">{{$cuser->name}}</div>
        </div>
        <div class="row mt-2">
            <div class="col-6 d-flex">
                <strong>Email:</strong>
            </div>
            <div class="col-6 d-flex">{{$cuser->email}}</div>
        </div>
        <div class="row mt-2">
            <div class="col-6 d-flex">
                <strong>Address:</strong>
            </div>
            <div class="col-6 d-flex">{{$cuser->address}}</div>
        </div>
        <div class="row mt-2">
            <div class="col-6 d-flex">
                <strong>Phone No.:</strong>
            </div>
            <div class="col-6 d-flex">{{$cuser->phone}}</div>
        </div>
       
        <div class="row mt-2">
            <div class="col-6 d-flex">
                <strong>Profile Image</strong>
            </div>
            <div class="col-6 d-flex" style="height: 150px; width:150px; object-fit:cover; overflow:hidden;margin:0px;
    padding: 0; border-radius: 5px;"><a href="{{asset('/profile_image/'.$cuser->image)}}">
                <img style="height: 100%; width:100%;" src="{{asset('/profile_image/'.$cuser->image)}}" alt=""></a></div>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <a href="{{route('editprofile')}}" class="btn btn-outline-dark">Edit Profile</a>
          </div>
        </div>
    </div>

</div>
   
</div>

@endsection