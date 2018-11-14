<!-- /resources/views/myUser/storeManage.blade.php  -->
<h1>StoreManage</h1>

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
<form method="POST" action="{{action('User\StoreManageController@storeManage')}}">
    @csrf
    Goods_id:<input type="text" name="goods_id"/></br></br>
    New Stock:<input type="text" name="new_num_stock"/></br></br>
    {{ csrf_field() }}
    <button type="submit">submit</button>
</form>
