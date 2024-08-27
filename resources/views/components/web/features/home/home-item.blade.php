<x-web.layout>
    <x-web.features.home.partials.jumbotron class="mb-8"/>
    @if(isset($placesFeatured))
        <h2 class="text-lg mb-4">Sed do eiusmod tempor</h2>
        <x-web.features.home.partials.place-featured class="mb-8" :places="$placesFeatured"/>
    @endif

    @if(isset($places))
        <h2 class="text-lg mb-4">Ut enim ad minim veniam</h2>
        <x-web.features.home.partials.place-list class="mb-8" :places="$places" />
    @endif

    @if(isset($posts))
        <h2 class="text-lg mb-4">Ut enim ad minim veniam</h2>
        <x-web.features.home.partials.blog-list class="mb-8" :posts="$posts" />
    @endif

    @if(isset($images))
        <h2 class="text-lg mb-4">Ut enim ad minim veniam</h2>
        <x-web.features.home.partials.gallery class="mb-8" :images="$images" />
    @endif

</x-web.layout>
