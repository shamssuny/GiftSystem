<div class="upre">

    <form action="" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <textarea name="details" placeholder="Post Body"></textarea>
        <input type="file" name="picture" accept="image/jpeg">
        <input type="submit" name="submit" value="Add Post">
    </form>

</div>


<div class="shpostu">

    @foreach($allPost as $post)
        <div class="aso">
            <small>{{ $post->details }}</small><br>
            @if($post->picture == 'none')

            @else
                <img src="{{ asset('/posts/'.$post->picture) }}" height="100px" width="100px" alt="">
            @endif
            <a onclick="return confirm('seriously?');" href="{{ url('cpanel/post/delete/'.$post->id) }}">delete</a>
        </div>
        <hr>
    @endforeach
    {{ $allPost->links() }}
</div>