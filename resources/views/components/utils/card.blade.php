@php
    $classes = 'flex flex-col justify-between h-full';
@endphp
<article {{$attributes->class([$classes])}}>
    @isset($header)
        <header {{$header->attributes->class([])}}>{{$header}}</header>
    @endisset

    @isset($body)
        <div {{$body->attributes->class(['flex-grow'])}}>{{$body}}</div>
    @endisset

    @isset($footer)
        <footer {{$footer->attributes->class(['mt-auto'])}}>{{$footer}}</footer>
    @endisset
</article>