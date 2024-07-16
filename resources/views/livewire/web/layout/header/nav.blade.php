<nav class="[&>a]:pl-2  text-skin-header">
    @foreach(config('myapp.headerNav') as $key => $item)
        <a class="pl-4 hover:text-skin-header-muted" href="{{--{{ route($navItem['route']) }}--}}">{{ $item['name'] }}</a>
    @endforeach
</nav>
