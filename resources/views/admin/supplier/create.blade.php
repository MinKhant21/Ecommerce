@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('supplier.index')}}" class="btn  btn-dark">All</a>
</div>
    <form action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Enter Your Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Enter Your Image</label>
            <input type="file" name="image" class="form-control">
            <textarea name="description" class="form-control"></textarea>
        </div>
       <input type="submit" name="Create" value="Create">
    </form>
@endsection