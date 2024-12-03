<nav>
    <ul>
        <li class="font-bold">Blog</li>

        @foreach(config('myapp.supplementaryNav.blog') as $key => $val)
            <li><a class="text-skin-supplementary hover:text-skin-supplementary-muted" href="{{ route($val['name'], $val['params'] ?? []) }}">{{ $val['name'] }}</a></li>

        @endforeach
    </ul>
</nav>