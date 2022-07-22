@extends('layout.master')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
            <!-- For Category and Information -->
            @include('layout.side')
            <div class="col-md-8">
                    <div class="card">

                            <div class="card-body">

                                <div class="row">
                                        <div class="12 p-3">
                                                <form action="">
                                                        <select name="color" class="btn btn-dark" id="">
                                                                <option value="">Color</option>
                                                                @foreach ($color as $c)
                                                                <option value="{{$c->slug}}">{{$c->name}}</option>
                                                                @endforeach
                                                        </select>
                                                        <select name="category" class="btn btn-dark" id="">
                                                                <option value="">Category</option>
                                                                @foreach ($category as $c)
                                                                <option value="{{$c->slug}}">{{$c->name}}</option>
                                                                @endforeach
                                                        </select>
                                                        <select name="Brand" class="btn btn-dark" id="">
                                                                <option value="">Brand</option>
                                                                @foreach ($brand as $c)
                                                                <option value="{{$c->slug}}">{{$c->name}}</option>
                                                                @endforeach
                                                        </select>
                                                        <input type="text" placeholder="Enter Name" class="btn btn-dark">
                                                        <input type="submit" class="btn btn-dark" value="Filter">
                                                        <a href="{{url('/')}}" class="btn btn-danger">Clear</a>

                                                </form>
                                                
                                        </div>
                                </div>

                                    <div class="row">
                                        @foreach ($product as $p)
                                             <!-- Loop Product -->
                                             <div class="col-md-4">
                                                <a href="{{url('/product/'.$p->slug)}}">
                                                        <div class="card">
                                                                <img class="card-img-top"
                                                                        src="{{asset('/images/'.$p->image)}}"
                                                                        alt="">
                                                                <div class="card-body">
                                                                        <div class="row">
                                                                                <div class="col-md-12">
                                                                                        <h4>
                                                                                                {{$p->name}}
                                                                                        </h4>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row">
                                                                                <div class="col-md-4">
                                                                                        <a href=""
                                                                                                class="badge badge-primary">{{$p->sell_price}}</a>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                        <a href=""
                                                                                                class="badge badge-warning">{{$p->category->name}}</a>
                                                                                </div>
                                                                        </div>


                                                                </div>
                                                        </div>
                                                </a>

                                        </div>
                                        @endforeach
                                        
                                           
                                            
                                    </div>
                                    <div class="row">
                                            <div class="col-md-6 offset-3">
                                                {{$product->links()}}
                                            
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
    </div>
</div>

@endsection