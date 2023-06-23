@extends('products.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        </div>
    </div>
</div>
   
@if(session()->has('flase_message'))
 <p>{{ session()->get('flase_message') }}</p>
@endif
   
<div class="container mt-3">
  <h2>Login form</h2>
  <form action="{{route('user.Login_in')}}" method="post">
    @csrf()
    <div class="mb-3">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{old('email')}}">
      @if($errors->has('email'))
      <p class="text-danger">{{$errors->first('email')}}</p>
      @endif
    </div>
    <div class="mb-3">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="{{old('password')}}">
      @if($errors->has('password'))
      <p class="text-danger">{{$errors->first('password')}}</p>
      @endif
    </div>
    <button type="submit" class="btn btn-outline-primary">Login</button>
    Don't haven account?<a href="{{route('user.register')}}"><input type="button"class="btn btn-outline-info" value="Register"></a>
  </form>
</div>
@endsection