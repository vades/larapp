<nav class="[&>a]:pl-2  text-skin-header">
    @foreach(config('myapp.headerNav') as $key => $val)
        <a class="pl-4 hover:text-skin-header-muted" href="{{ route($val['name']) }}">{{ $val['name'] }}</a>
    @endforeach
</nav>
