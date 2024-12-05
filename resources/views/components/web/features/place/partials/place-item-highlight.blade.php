@props(['highlights'])
<section {{$attributes->class(['grid grid-cols-2 gap-2 md:grid-cols-6 lg:grid-cols-8'])}}>
    @foreach($highlights as $item)
        <a class="text-skin-place" href="{{ route('placeItem',  ['placeId'=>$item->slug]) }}">
            <x-utils.card class="bg-skin-place">
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