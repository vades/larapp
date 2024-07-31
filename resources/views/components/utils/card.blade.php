@php
    $classes = 'md:flex md:flex-col md:justify-between';
@endphp
<article {{$attributes->class([$classes])}}>
    @isset($header)
        <header {{$header->attributes->class([])}}>{{$header}}</header>
    @endisset

    @isset($body)
        <div {{$body->attributes->class([])}}>{{$body}}</div>
    @endisset

    @isset($footer)
        <footer {{$footer->attributes->class([])}}>{{$footer}}</footer>
    @endisset
</article>