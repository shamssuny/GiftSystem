<form action="{{ url('/prizes/order/'.$setId) }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $setId }}">
    <input type="text" name="name" placeholder="Your Name"><br>
    <input type="text" name="phone" placeholder="Mobile"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <textarea name="address" placeholder="Delivery Address"></textarea><br>
    <input type="submit" name="submit" value="Order">
</form>