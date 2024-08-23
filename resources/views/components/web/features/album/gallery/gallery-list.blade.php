<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section class="grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-5">
        @foreach(collect($images) as $image)
            <figure class="cursor-pointer">
                <img class="h-auto max-w-full rounded" src="{{ $image->thumbnail }}" alt="{{ $image->title }}"/>
            </figure>
        @endforeach
    </section>

</x-web.layout>