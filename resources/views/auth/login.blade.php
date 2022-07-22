@extends('layout.master')

@section('content')
<div class="container mt-3">
    <div class="row">
    @include('layout.side')
    <div class="col-md-8">
        <div class="card">
            @if (session()->has('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif
@if (session()->has('success'))
<div class="alert alert-danger">
    {{session('success')}}
</div>
@endif
            <div class="card-header bg-primary text-white text-center">
                LogIn
            </div>
            <div class="cardbody">
                <form action="{{url('/login')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Enter Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Enter Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <input type="submit" name="login" value="Login" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection