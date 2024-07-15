<nav>
    <ul>
        <li><a class="font-bold">Blog</a></li>

        @foreach(config('myapp.supplementaryNav.blog') as $key => $val)
            <li><a href="{{ route($val['name'], $val['params'] ?? []) }}">{{ $val['name'] }}</a></li>

        @endforeach
    </ul>
</nav>
