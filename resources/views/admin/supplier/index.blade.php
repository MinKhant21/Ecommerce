@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('supplier.create')}}" class="btn  btn-success">Create</a>

</div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($supplier as $s)
            <tr>
                <td>{{$s->name}}</td>
                <td>                 
                    <img src="{{asset('/images/'.$s->image)}}" class="img-thumbnail" width="100px" alt="">                
                </td>
                <td>{{$s->description}}</td>
                <td>
                    <a href="{{route('supplier.edit',$s->id)}}" class="btn  btn-primary">Edit</a>
                    <form action="{{route('supplier.destroy',$s->id)}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

            
        </tbody>
    </table>
@endsection