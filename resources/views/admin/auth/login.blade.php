@if ($errors->any())
    
    @foreach ($errors->all() as $e)
        {{$e}}
    @endforeach

@endif


@if (session()->has('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif


<form action="/admin/login" method="POST">
@csrf
<label for="email">Enter Your Email : </label>
<input type="email" name="email">
<label for="password">Enter Your Password : </label>
<input type="password" name="password">
<input type="submit" value="Login">

</form>