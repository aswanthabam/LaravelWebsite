@extends("theme.base")
@section('head')
<link rel="stylesheet" href="/static/css/form/form-style.css"/>
<style>
.body-background
{
    display: none;
}
</style>
@endsection
@section("body")
<div class="centering-element">
<form class="form-control" action="authenticate" method="post">
	<center><h3>Login</h3></center>
	@csrf
	<input name="email" placeholder="Enter e-mail or username"/>
	<input type="password" name="password" placeholder="Password"/>
	<div class="form-group">
	<input type="checkbox" name="remember_me"/>
	<label for="remember_me">Remember Me</label>
	</div>
	<input type="submit" value="Login"/>
</form>
</div>
@endsection