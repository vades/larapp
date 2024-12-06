@props(['images'])
<section {{$attributes->class(['grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-6'])}}>
    @foreach(collect($images)->take(6) as $item)
        <x-utils.card class="bg-skin-album">
            <x-slot name="header">
                <img class="mr-auto ml-auto image-thumbnail w-64 h-64 object-cover transform transition-transform duration-300 hover:scale-110"
                     src="{{$item->src}}"
                     alt="{{ $item->title}}">
            </x-slot>
        </x-utils.card>
    @endforeach
</section>