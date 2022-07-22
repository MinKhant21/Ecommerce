@extends('layout.master')

@section('content')
<div class="container mt-3">
    <div class="row">
    @include('layout.side')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                Register
            </div>
            <div class="cardbody">
                @if ($errors->any())
                    @foreach ($errors->all() as $e)
                        <div class="alert alert-danger">{{$e}}</div>
                    @endforeach
                @endif
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Enter Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                    <input type="submit" name="register" value="Register" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection