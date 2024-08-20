@props(['highlights'])
<section {{$attributes->class(['grid grid-cols-2 gap-2 md:grid-cols-6 lg:grid-cols-8'])}}>
    @foreach(collect($highlights)->take(8) as $place)
        <a href="{{ route('placeItem',  ['placeId'=>$place->slug]) }}">
            <x-utils.card class="bg-skin-base">
                <x-slot name="header">
                    <img class="mr-auto ml-auto"
                         src="{{$place->imageUrl}}"
                         alt="{{ $place->title}}">
                </x-slot>
                <x-slot name="body" class="p-3">
                    <h2 class="text-lg font-bold mb-3">{{ $place->title }}</h2>
                </x-slot>
            </x-utils.card>
        </a>
    @endforeach
</section>