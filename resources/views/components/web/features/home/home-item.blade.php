<x-web.layout>
    <x-web.features.home.partials.jumbotron class="mb-8" />
    @if(isset($placesFeatured))
        <div class="mb-4">
            <h2 class="text-lg mb-4">Featured places</h2>
            <x-web.features.home.partials.place-featured class="mb-8" :places="$placesFeatured" />
        </div>
    @endif

    @if(isset($places))
        <div class="mb-4"><h2 class="text-lg mb-4">List of places</h2>
            <x-web.features.home.partials.place-list class="mb-8"
                                                     :places="$places" />
            <div class="text-center"><a class="button"
                                        href="{{ route('placeList') }}">More places</a></div>
        </div>
    @endif

    @if(isset($posts))
        <div class="text-lg mb-4"><h2 class="text-lg mb-4">Blog list</h2>
            <x-web.features.home.partials.blog-list class="mb-8"
                                                    :posts="$posts" />
            <div class="text-center"><a class="button"
                                        href="{{ route('blogList') }}">More articles</a></div>
        </div>
    @endif

    @if(isset($images))
        <div class="text-lg mb-4"><h2 class="text-lg mb-4">Photogallery</h2>
            <x-web.features.home.partials.gallery class="mb-8"
                                                  :images="$images" />
            <div class="text-center"><a class="button"
                                        href="{{ route('albumList') }}">More images</a></div>
        </div>
    @endif

</x-web.layout>
