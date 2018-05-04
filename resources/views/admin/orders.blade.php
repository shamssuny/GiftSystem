<div class="all">
    <p>Pending For Delivered: {{ $getPendings }}</p>
    @php $arr = array('pending','sent','delivered','delete'); @endphp
    @forelse($getAllOrders as $orders)
        <div class="oder">
            <span>Product: {{ $orders->prize_name }}</span><br>
            <span>Name: {{ $orders->name }}|| </span>
            <span>Email: {{ $orders->email }}|| </span>
            <span>Phone: {{ $orders->phone }}}|| </span>
            <span>Address: {{ $orders->address }}|| </span>
            <form action="{{ url('cpanel/orders/status/'.$orders->id) }}" method="post">
                {{ csrf_field() }}
                <select name="status" id="">
                    @foreach($arr as $ar)
                        @if($ar == $orders->status)
                            <option value="{{ $orders->status }}" selected>{{ $orders->status }}</option>
                         @else
                            <option value="{{ $ar }}">{{ $ar }}</option>
                        @endif
                    @endforeach
                </select>
                <input type="submit" name="submit" value="save">
            </form>
        </div>
        <hr>
    @empty
    @endforelse

    {{ $getAllOrders->links() }}

</div>