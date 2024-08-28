@props(['posts'])
<section {{$attributes->class(['md:grid md:grid-cols-2 md:gap-4'])}}>
    @foreach(collect($posts)->take(4) as $item)
        <a href="{{ route('blogItem',  ['postId'=>$item->slug]) }}">
            <x-utils.panel class="bg-skin-base">
                <x-slot name="header">
                    <figure class="mb-3 md:mr-3">
                        <img src="{{$item->imageUrl}}"
                             alt="{{ $item->title}}">
                    </figure>

                </x-slot>
                <x-slot name="body"
                        class="p-3">
                    <h3 class="text-lg mb-3">{{ $item->title }}</h3>
                    <div class="mb-3">{{ $item->description }}</div>
                </x-slot>
            </x-utils.panel>
        </a>
    @endforeach
</section>