@extends('products.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products List </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td><img src="{{asset('/images/'.$product->image)}}" width="100px"></td>
            <td>{{optional($product->createdby)->name ? optional($product->createdby)->name:'-'}}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST" enctype="multipart/form-data">
   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        <div class="mb-3">
            <a href="{{route('category.index')}}"><input type="button"class="btn btn-outline-info" value="category"></a>
            </div>
    </table>
    <div class="mb-3">
        <a href="{{route('user.logout')}}"><input type="button" class="btn btn-primary btn-sm" value="Logout"></a>
    </div>
  
    {!! $Products->links()  !!}
      
@endsection