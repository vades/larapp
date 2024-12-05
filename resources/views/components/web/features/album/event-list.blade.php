<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section class="grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-5">
    @foreach(collect($events) as $item)
            <a class="text-skin-album" href="{{ route('albumEventList', $item->albumId) }}/{{$item->id}}">
                <x-utils.card class="bg-skin-album">
                    <x-slot name="header">
                        <img class="mr-auto ml-auto"
                             src="{{$item->src}}"
                             alt="{{ $item->title}}">
                    </x-slot>
                    <x-slot name="body" class="p-2 text-center">
                        <h3 class="text-lg mb-3">{{ $item->title }}</h3>
                    </x-slot>
                </x-utils.card>

            </a>
    @endforeach
    </section>
</x-web.layout>