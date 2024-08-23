<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section class="grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-5">
    @foreach(collect($events) as $item)
                <a href="{{ route('albumEventList', $item->albumId) }}/{{$item->id}}">
        <figure class="cursor-pointer">
            <img class="h-auto max-w-full rounded" src="{{ $item->src }}" alt="{{ $item->title }}"/>
            {{$item->title}}
        </figure>
            </a>
    @endforeach
    </section>
</x-web.layout>