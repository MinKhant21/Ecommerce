@extends('layout.master')
        <!-- End Header -->
@section('content')
<div class="container-fluid mt-3">
        <div class="row">
                <!-- For Category and Information -->
                @include('layout.side')

                        <div class="col-md-8">
                                <div class="card">
                                        <div class="card-body">
                                                <h2>Your Cart List</h2>
                                                <table class="table table-striped">
                                                        <thead>
                                                                <tr>
                                                                      
                                                                        <th>Image</th>
                                                                        <th>Name</th>                                                                      
                                                                        <th>Total Qty</th>
                                                                        <th>Action</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                                @php
                                                                    $total_price = 0;
                                                                @endphp
                                                                @foreach ($carts as $c)
                                                                @php
                                                                    $total_price += $c->total_quantity*$c->product->sell_price;
                                                                @endphp
                                                                    <tr>
                                                                        <td>
                                                                                <img src="{{$c->product->image_url}}" width="50" class="img-thumbnail" alt="">
                                                                        </td>
                                                                        <td>
                                                                                {{$c->product->name}}
                                                                        </td>
                                                                        <td>
                                                                                {{$c->total_quantity}}
                                                                        </td>
                                                                        <td>
                                                                                <a href="" class="btn btn-sm btn-dark">-</a>
                                                                                <a href="" class="btn btn-sm btn-dark">+</a>
                                                                                <a href="" class="btn btn-sm btn-danger">
                                                                                        <i class="fa fa-trash"></i>
                                                                                </a>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                                <span class="float-right">
                                                                                        <span>Total Price : <b>{{$total_price}}</b></span>
                                                                                        <a href="" class="btn btn-primary">CheckOut</a>
                                                                                </span>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                
                                                        </tbody>
                                                </table>
                                                
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
  


@endsection