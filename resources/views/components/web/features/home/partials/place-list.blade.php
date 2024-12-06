@props(['places'])
<section {{$attributes->class(['sm:grid sm:grid-cols-2 sm:gap-2 md:gap-3 md:grid-cols-3 lg:grid-cols-4 text-skin-place'])}}>
    @foreach($places as $item)
        <a class="text-skin-place" href="{{ route('placeItem',  ['placeId'=>$item->slug]) }}">
            <x-utils.card class="bg-skin-place">
                <x-slot name="header">
                    <img class="mr-auto ml-auto"
                         src="{{$item->image_url}}"
                         alt="{{ $item->title}}">
                </x-slot>
                <x-slot name="body"
                        class="p-3">
                    <h2 class="text-center  mb-3">{{ $item->title }}</h2>
                   {{--  <div class="mb-3">
                        {{ $item->description }}
                    </div> --}}
                </x-slot>
                <x-slot name="footer"
                        class="p-3">
                    <div class="text-center pb-3">
                        <span class="read-more">Read More</span>
                    </div>
                </x-slot>
            </x-utils.card>
        </a>
    @endforeach
</section>