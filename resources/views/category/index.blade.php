@extends('category.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Category List </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('category.create') }}"> Create New category</a>
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
            <th>status</th>
            <th width="280px">Action</th>
        </tr>
       
        @foreach ($list as $category)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $category->name }}</td>
            <td>
            @if($category->status==0)
                <td>active</td>
                @else
                <td>inactive</td>
                @endif
            <td>
                <form action="{{ route('category.destroy',$category->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('category.show',$category->id) }}">Show</a>
                    @if(optional($category->categorys)->count())
                    <a class="btn btn-primary" href="{{ route('category.edit',$category->id) }}">Edit</a>
                    @endif
                    @if(!optional($category->categorys)->count())
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
        <div class="mb-3">
            <a href="{{route('products.index')}}"><input type="button"class="btn btn-outline-info" value="products"></a>
            </div>
    </table>
    <div class="mb-3">
        <a href="{{route('user.logout')}}"><input type="button" class="btn btn-primary btn-sm" value="Logout"></a>
    </div>
{{--   
    {!! $categorys->links() !!} --}}
      
@endsection