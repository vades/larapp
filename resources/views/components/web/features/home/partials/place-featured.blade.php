@props(['places'])
<section {{$attributes->class(['md:grid  gap-2 md:grid-cols-2 lg:grid-cols-3 text-skin-featured'])}}>
    @foreach($places as $item)
        <a class="text-skin-featured" href="{{ route('placeItem',  ['placeId'=>$item->slug]) }}">
            <x-utils.card class="bg-skin-featured">
                <x-slot name="header">
                    <img class="mr-auto ml-auto"
                         src="{{$item->image_url}}"
                         alt="{{ $item->title}}">
                </x-slot>
                <x-slot name="body"
                        class="p-2 text-center">
                    <h3 class="text-lg mb-3">{{ $item->title }}</h3>
                </x-slot>
            </x-utils.card>
        </a>
    @endforeach
</section>