<nav>
    <ul>
        <li><a class="font-bold">Albums</a></li>

        @foreach(config('myapp.supplementaryNav.album') as $key => $item)
            <li><a href="{{--{{ route($navItem['route']) }}--}}">{{ $item['name'] }}</a></li>

        @endforeach
    </ul>
</nav>
