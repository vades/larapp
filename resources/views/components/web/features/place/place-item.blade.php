<x-web.layout :title="$page->metaTitle"
              :description="$page->metaDescription"
              :keywords="$page->keywords">

    <x-web.features.place.partials.place-item-header :place="$place" class="mb-8" />
    @if(isset($images))
        <x-utils.lightbox :images="$images"/>
   {{--  <x-web.features.place.partials.place-item-gallery :images="$images" class="mb-8" /> --}}
    @endif

    @if(isset($place->content))
        <section class="mb-8">
            {!! $place->content !!}
        </section>
    @endif

    @if(isset($highlights) && count($highlights) > 0)
        <h2 class="text-lg mb-4">Altstadt - St. Lorenz highlights</h2>
     <x-web.features.place.partials.place-item-highlight :highlights="$highlights" class="mb-8" />
    @endif

    @if(isset($related) && count($related) > 0)
        <h2 class="text-lg mb-4">Other places in category</h2>
    <x-web.features.place.partials.place-item-related :related="$related" class="mb-8" />
    @endif


    <x-utils.prev-next class="flex justify-center mt-8"
                       :prevUrl="$previousPlace"
                       :nextUrl="$nextPlace" />
</x-web.layout>