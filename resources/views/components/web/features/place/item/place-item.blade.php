<x-web.layout :title="$page->metaTitle"
              :description="$page->metaDescription"
              :keywords="$page->keywords">

    <x-web.features.place.item.place-item-header :place="$place" class="mb-8" />
    @if(isset($images))
    <x-web.features.place.item.place-item-gallery :images="$images" />
    @endif

    @if(isset($highlights))
    <x-web.features.place.item.place-item-highlight :highlights="$highlights" />
    @endif

    @if(isset($related))
    <x-web.features.place.item.place-item-related :related="$related" />
    @endif

    @if(isset($place->content))
    <section>
        {!! $place->content !!}
    </section>
    @endif

    <x-utils.prev-next class="flex justify-center mt-8"
                       prevUrl="#"
                       nextUrl="#" />
</x-web.layout>