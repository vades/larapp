<nav class="[&>a]:pl-2">
    @foreach(config('myapp.footerNav') as $key => $item)
        <a class="hover:text-skin-footer-muted" href="{{--{{ route($navItem['route']) }}--}}">{{ $item['name'] }}</a>
    @endforeach
</nav>
