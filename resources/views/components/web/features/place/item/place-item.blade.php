<x-web.layout :title="$page->metaTitle"
              :description="$page->metaDescription"
              :keywords="$page->keywords">

    <x-web.features.place.item.place-item-header :place="$place" class="mb-8" />
    @if(isset($images))
    <x-web.features.place.item.place-item-gallery :images="$images" class="mb-8" />
    @endif

    @if(isset($place->content))
        <section class="mb-8">
            {!! $place->content !!}
        </section>
    @endif

    @if(isset($highlights))
        <h2 class="text-lg mb-4">Altstadt - St. Lorenz highlights</h2>
    <x-web.features.place.item.place-item-highlight :highlights="$highlights" class="mb-8" />
    @endif

    @if(isset($related))
        <h2 class="text-lg mb-4">Other places in category</h2>
    <x-web.features.place.item.place-item-related :related="$related" class="mb-8" />
    @endif


    <x-utils.prev-next class="flex justify-center mt-8"
                       prevUrl="#"
                       nextUrl="#" />
</x-web.layout>