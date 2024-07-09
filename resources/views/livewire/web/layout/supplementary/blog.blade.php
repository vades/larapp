<nav>
    <ul>
        <li><a class="font-bold">Blog</a></li>

        @foreach(config('myapp.supplementaryNav.blog') as $key => $item)
            <li><a href="{{--{{ route($navItem['route']) }}--}}">{{ $item['name'] }}</a></li>

        @endforeach
    </ul>
</nav>
