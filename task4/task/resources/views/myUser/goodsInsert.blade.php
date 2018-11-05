<!-- /resources/views/myUser/register.blade.php  -->
<h1>GoodsInsert</h1>

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
<form method="POST" action="{{action('User\GoodsInsertController@store')}}">
    @csrf
    Goods Name:<input type="text" name="goods_name"/></br></br>
    Price:<input type="text" name="price"/></br></br>
    number_stock:<input type="text" name="number_stock"/></br></br>
    shop_name:<input type="text" name="shop_name"/></br></br>
    {{ csrf_field() }}
    <button type="submit">submit</button>
</form>
