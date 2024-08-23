<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section class="grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-5">
        @foreach(collect($images) as $item)
            <x-utils.card class="bg-skin-base">
                <x-slot name="header">
                    <img class="mr-auto ml-auto"
                         src="{{$item->src}}"
                         alt="{{ $item->title}}">
                </x-slot>
            </x-utils.card>
        @endforeach
    </section>

</x-web.layout>