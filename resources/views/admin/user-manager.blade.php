<div class="ull">
    @php $urr = array('yes','no','delete'); @endphp

    <form action="{{ URL::current() }}/search" method="GET">
        <input type="text" name="search" placeholder="Search">
        <input type="submit" name="submit" value="Search">
    </form>

    @if(isset($searchUsers))
        @foreach($searchUsers as $user)
            <div class="user-cekson">
                <span>{{ $user->username }} || email: {{ $user->email }}</span><br>
                <span>Points: {{ $user->point->total_points }}</span>
                <form action="{{ url('cpanel/user-manager/action/'.$user->id) }}" method="post">
                    {{ csrf_field() }}
                    <select name="status">
                        @foreach($urr as $u)
                            @if($u == $user->active)
                                <option value="{{ $u }}" selected>{{ $u }}</option>
                            @else
                                <option value="{{ $u }}">{{ $u }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="submit" name="submit" value="Save">
                </form>
            </div>
            <hr>
        @endforeach
    @else
        @foreach($users as $user)
            <div class="user-cekson">
                <span>{{ $user->username }} || email: {{ $user->email }}</span><br>
                <span>Points: {{ $user->point->total_points }}</span>
                <form action="{{ url('cpanel/user-manager/action/'.$user->id) }}" method="post">
                    {{ csrf_field() }}
                    <select name="status">
                        @foreach($urr as $u)
                            @if($u == $user->active)
                                <option value="{{ $u }}" selected>{{ $u }}</option>
                            @else
                                <option value="{{ $u }}">{{ $u }}</option>
                            @endif
                        @endforeach
                    </select>
                    <input type="submit" name="submit" value="Save">
                </form>
            </div>
            <hr>
        @endforeach
        {{ $users->links() }}
    @endif

</div>