<div class="upper-prize">
    @include('errors.error')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="text" name="name" placeholder="Prize Name">
        <input type="number" name="price" placeholder="Price">
        <input type="number" name="quantity" placeholder="Quantity">
        <input type="file" name="picture" accept="image/jpeg">
        <input type="submit" name="submit" value="Add">
    </form>
    <a href="{{ url('cpanel/prize/restock') }}">Change Restock Mode</a>
    <small>Restock Mode: {{ $restock->restock }}</small>
</div>
<hr>
<div class="prize-list">
    @forelse($prizes as $prize)
        <div class="product">
            <img height="100px" width="100px" src="{{ asset('/prize/'.$prize->picture) }}" alt="">
            <p>name: {{ $prize->name }}</p>
            <p>price: {{ $prize->price }}</p>
            <p>quantity: {{ $prize->quantity }}</p>
            <a onclick="return confirm('sure?');" href="{{ url('cpanel/prize/delete/'.$prize->id) }}">delete</a>
        </div>
    @empty
    @endforelse

    {{ $prizes->links() }}
</div>