<x-web.layout :title="$page->metaTitle"
              :description="$page->metaDescription"
              :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section class="sm:grid sm:grid-cols-2 sm:gap-2 md:gap-3 md:grid-cols-3 lg:grid-cols-4">
        @foreach($places as $place)
            <a href="{{ route('placeItem',  ['placeId'=>$place->slug]) }}">
                <x-web.features.place.list.place-list-card :place="$place" />
            </a>

        @endforeach
    </section>

</x-web.layout>