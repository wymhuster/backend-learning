<!-- /resources/views/myUser/register.blade.php  -->
<h1>Register</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create Post Form -->
<form method="POST" action="{{action('User\RegisterController@register')}}">
    @csrf
    Name:<input type="text" name="name"/></br></br>
    Password:<input type="password" name="password"/></br></br>
    Tel:<input type="text" name="telephone_number"/></br></br>
    Birthday:<input type="text" name="birthday"/></br></br>
    Province:<input type="text" name="province"/></br></br>
    Gender:<input type="text" name="gender"/></br></br>
    {{ csrf_field() }}
    <button type="submit">submit</button>
</form>
