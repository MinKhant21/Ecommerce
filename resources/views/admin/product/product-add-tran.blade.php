@extends('admin.layout.master')

@section('content')
<div>
    <a href="{{route('product.create')}}" class="btn  btn-success">Create</a>

</div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Supplier Name</th>
                <th>Buy Date</th>
                <th>Total Quantity</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($transaction as $s)
            <tr>
                
                <td>                 
                    {{-- <img src="{{asset('/images/'.$s->product->image)}}" class="img-thumbnail" width="100px" alt="">                
                </td> --}}
                <td></td>
                <td>{{$s->supplier->name}}</td>
                <td>{{$s->buy_date}}</td>
                <td>{{$s->total_quantity}}</td>
                
                
                <td>{{$s->description}}</td>
                
            </tr>
            @endforeach

            
        </tbody>
    </table>
@endsection