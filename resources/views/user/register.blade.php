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
  <h2>Register form</h2>
  <form action="{{route('user.regstore')}}" method="post">
    @csrf()
    <div class="mb-3 mt-3">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{old('name')}}">
        
    </div>
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
    <div class="mb-3">
      <label for="cpassword">ConfirmPassword</label>
      <input type="password" class="form-control" id="cpassword" placeholder="Enter confirm password" name="cpassword" value="{{old('cpassword')}}">
      @if($errors->has('cpassword'))
      <p class="text-danger">{{$errors->first('cpassword')}}</p>
      @endif
    </div>
    
    <button type="submit" class="btn btn-outline-primary">Register</button>
    Have already an account?<a href="{{route('user.login')}}"><input type="button"class="btn btn-outline-info" value="Login"></a>
  </form>
</div>
@endsection