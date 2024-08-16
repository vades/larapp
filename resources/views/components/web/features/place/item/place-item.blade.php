<x-web.layout :title="$page->metaTitle"
              :description="$page->metaDescription"
              :keywords="$page->keywords">

    <x-web.features.place.item.place-item-header :page="$page" />
    <x-web.features.place.item.place-item-gallery />
    <x-web.features.place.item.place-item-highlight />
    <x-web.features.place.item.place-item-related />
    <x-utils.prev-next class="flex justify-center mt-8"
                       prevUrl="#"
                       nextUrl="#" />
</x-web.layout>