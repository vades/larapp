<nav class="[&>a]:pl-2">
    @foreach(config('myapp.footerNav') as $key => $val)
        <a class="pl-4 hover:text-skin-header-muted" href="{{ route($val['name'], $val['params'] ?? []) }}">{{ $val['name'] }}</a>
    @endforeach
</nav>
