<nav>
    <ul>
        <li><a class="font-bold">Album</a></li>

        @foreach(config('myapp.supplementaryNav.album') as $key => $val)
            <li><a href="{{ route($val['name'], $val['params'] ?? []) }}">{{ $val['name'] }}</a></li>

        @endforeach
    </ul>
</nav>
