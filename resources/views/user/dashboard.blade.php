@extends('products.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        </div>
    </div>
</div>
   
<form action="{{route('user.dashboard')}}" method="post">
    @csrf()
<div class="container mt-3">
  <h2>Dashboard page</h2>
    <div class="mb-3">
    <a href="{{route('category.index')}}"><input type="button"class="btn btn-outline-info" value="category"></a>
    </div>
    <div class="mb-3">
    <a href="{{route('products.index')}}"><input type="button"class="btn btn-outline-info" value="products"></a>
    </div>
    <div class="mb-3">
    <a href="{{route('user.logout')}}"><input type="button" class="btn btn-primary btn-sm" value="Logout"></a>
    </div>
    </form>
</div>
@endsection