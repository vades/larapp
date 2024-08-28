<x-web.layout>
    <x-web.features.home.partials.jumbotron class="mb-8"/>
    @if(isset($placesFeatured))
        <h2 class="text-lg mb-4">Sed do eiusmod tempor</h2>
        <x-web.features.home.partials.place-featured class="mb-8" :places="$placesFeatured"/>
    @endif

    @if(isset($places))
        <h2 class="text-lg mb-4">Ut enim ad minim veniam</h2>
        <x-web.features.home.partials.place-list class="mb-8" :places="$places" />
        <div class="text-center"><a class="block-inline py-2.5 px-5 me-2 mb-2 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
              href="{{ route('placeList') }}">More places</a></div>
    @endif

    @if(isset($posts))
        <h2 class="text-lg mb-4">Ut enim ad minim veniam</h2>
        <x-web.features.home.partials.blog-list class="mb-8" :posts="$posts" />
        <div class="text-center"><a class="block-inline py-2.5 px-5 me-2 mb-2 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                                    href="{{ route('blogList') }}">More articles</a></div>
    @endif

    @if(isset($images))
        <h2 class="text-lg mb-4">Ut enim ad minim veniam</h2>
        <x-web.features.home.partials.gallery class="mb-8" :images="$images" />
        <div class="text-center"><a class="block-inline py-2.5 px-5 me-2 mb-2 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100"
                                    href="{{ route('albumList') }}">More images</a></div>
    @endif

</x-web.layout>
