@props(['related'])
<section {{$attributes->class(['md:grid md:grid-cols-2 md:gap-4'])}}>
    @foreach(collect($related)->take(8) as $place)
        <a href="{{ route('placeItem',  ['placeId'=>$place->slug]) }}">
            <x-utils.panel class="bg-skin-base">
                <x-slot name="header">
                    <figure class="mb-3 md:mr-3">
                        <img src="{{$place->imageUrl}}" alt="{{ $place->title}}">
                    </figure>

                </x-slot>
                <x-slot name="body" class="p-3">
                    <h3 class="text-lg mb-3">{{ $place->title }}</h3>
                    <div class="mb-3">{{ $place->description }}</div>
                </x-slot>
            </x-utils.panel>
        </a>
    @endforeach
</section>