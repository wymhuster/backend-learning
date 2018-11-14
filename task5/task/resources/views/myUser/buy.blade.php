<!-- /resources/views/myUser/buy.blade.php  -->
<h1>Goods Buy</h1>

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
<form method="POST" action="{{action('User\BuyController@goodsBuy')}}">
    @csrf
    Goods_id:<input type="text" name="goods_id"/></br></br>
    Num:<input type="text" name="quantity"/></br></br>
    Receipt_id:<input type="text" name="receipt_id"/></br></br>
    {{ csrf_field() }}
    <button type="submit">submit</button>
</form>
