<nav>
    <ul>
        <li><a class="font-bold">Places</a></li>

        @foreach(config('myapp.supplementaryNav.place') as $key => $item)
            <li><a href="{{--{{ route($navItem['route']) }}--}}">{{ $item['name'] }}</a></li>

        @endforeach
    </ul>
</nav>
