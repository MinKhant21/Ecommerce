@extends('admin.layout.master')

@section('content')
<div>
    <h2 class="text-danger">
        Add Product for <b class="text-warning">{{$product->name}}</b>
    </h2>
</div>
    <form action="{{url('/admin/create-product-add/'.$product->id)}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Choose Supplier</label>
            <select name="supplier_id" id="" class="form-control">
                @foreach ($supplier as $s)
                <option value="{{$s->id}}">{{$s->name}}</option>
                @endforeach
                
            </select>
        </div>
        {{-- <div class="form-group">
            <label for="">Enter Buy Price</label>
            <input type="number" class="form-control" name="buy_price">
        </div> --}}
        <div class="form-group">
            <label for="">Enter Total Quantity</label>
            <input type="number" class="form-control" name="total_quantity">
        </div>
        <div class="form-group">
            <label for="">Enter Description</label>
            <textarea name="description"  class="form-control"></textarea>
        </div>
        <input type="submit" value="Add">
    </form>
@endsection