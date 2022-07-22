@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('supplier.index')}}" class="btn  btn-dark">All</a>

</div>
    <form action="{{route('supplier.update',$supplier->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Enter Your Name</label>
            <input type="text" name="name" value="{{$supplier->name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Enter Your Image</label>
            <input type="file" name="image" class="form-control">
            <img src="{{asset('/images/'.$supplier->image)}}" width="100px" class="img-thumbnail" alt="">
            <textarea name="description" class="form-control">{{$supplier->description}}</textarea>
        </div>
       <input type="submit" name="update" value="Update">
    </form>
@endsection