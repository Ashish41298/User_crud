@extends('layout')

@section('main')

<div class="container mt-3">
<div class="card text-center">
  <div class="card-header">
    User Registration
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
  <div class="formbox" style="max-width: 350px; width:350px;">
    <form action="{{route('registerdata')}}" method="post" enctype="multipart/form-data" >
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label">User Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter the user name" value="{{old('name')}}">
            @error('name')
            <div class="form-text" style="color: crimson;">
                {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Email </label>
            <input type="email" class="form-control" name="email" placeholder="Enter the Email" value="{{old('eamil')}}">
            @error('email')
            <div style="color: crimson;"class="form-text">
                {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter the password" >
            @error('password')
            <div style="color: crimson;" class="form-text">
                {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" cols="30" rows="2" placeholder="Enter the Address">{{old('address')}}</textarea>
            @error('address')
            <div style="color: crimson;" class="form-text">
                {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Phone No.</label>
            <input type="number" class="form-control" name="phone" placeholder="Enter the phone no." value="{{old('phone')}}">
            @error('phone')
            <div style="color: crimson;" class="form-text">
                {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label class="form-label"> User image</label>
            <input type="file" class="form-control" name="image" placeholder="Select the image">
            @error('image')
            <div class="form-text" style="color: crimson;">
                {{$message}}
              </div>
            @enderror
        </div>
            <div class=" text-center">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>        
        </form>
    </div>
  </div>
</div>
   
</div>

@endsection