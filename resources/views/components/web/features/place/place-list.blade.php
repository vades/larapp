<x-web.layout :title="$page->metaTitle"
              :description="$page->metaDescription"
              :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section class="sm:grid sm:grid-cols-2 sm:gap-2 md:gap-3 md:grid-cols-3 lg:grid-cols-4">
        @foreach($places as $place)
            <a href="{{ route('placeItem',  ['placeId'=>$place->slug]) }}">
                <x-utils.card class="bg-skin-base">
                    <x-slot name="header">
                        <img class="mr-auto ml-auto"
                             src="{{$place->imageUrl}}"
                             alt="{{ $place->title}}">
                    </x-slot>
                    <x-slot name="body" class="p-3">
                        <h2 class="text-2xl font-bold mb-3">{{ $place->title }}</h2>
                        <div class="mb-3">
                            {{ $place->description }}
                        </div>
                    </x-slot>
                    <x-slot name="footer" class="p-3">
                        <div>
                            <span class="btn btn-primary">Read More</span>
                        </div>
                    </x-slot>
                </x-utils.card>
            </a>

        @endforeach
    </section>
    <section>
        <x-utils.pagination class="flex justify-center mt-8" />
    </section>
</x-web.layout>