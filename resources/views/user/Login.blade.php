@extends('layout')

@section('main')

<div class="container mt-3">
<div class="card text-center">
  <div class="card-header">
    User Login
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
    <form action="{{route('logindata')}}" method="post" >
        @csrf
        <div class="mb-3 text-start">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter the Email">
            @error('email')
            <div style="color: crimson;" class="form-text">
                {{$message}}
              </div>
            @enderror
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter the password">
            @error('password')
            <div style="color: crimson;" class="form-text">
                {{$message}}
              </div>
            @enderror
        </div>
            <div class="d-flex align-items-center justify-content-between">
                <button type="submit" class="btn btn-primary">login</button>
                <a href="{{route('register')}}">don't have account? Register</a>
            </div>        
        </form>
    </div>
  </div>
</div>
   
</div>

@endsection