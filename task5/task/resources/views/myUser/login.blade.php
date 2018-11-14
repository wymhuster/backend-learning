<!-- /resources/views/myUser/login.blade.php  -->
<h1>Login</h1>


<!-- Login Form -->
<form method="POST" action="{{action('User\LoginController@check')}}">
    @csrf
    Name:<input type="text" name="name"/></br></br>
    Password:<input type="password" name="password"/></br></br>
    <button type="submit">login</button>
    {{ csrf_field() }}
</form>
