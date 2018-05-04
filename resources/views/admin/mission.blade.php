<h2>mission page</h2>

<div class="make-link">
    <form action="" method="post">
        {{ csrf_field() }}
        <input type="text" name="links" placeholder="Put a Link">
        <input type="submit" name="submit" value="Add">
    </form>
</div>

<div class="manage-links">

    @foreach($missions as $mission)
        <p>{{ $mission->links }} <a onclick="return confirm('sure delete?');" href="{{ url('cpanel/mission/delete/'.$mission->id) }}">Delete</a></p>
    @endforeach

    {{ $missions->links() }}

</div>