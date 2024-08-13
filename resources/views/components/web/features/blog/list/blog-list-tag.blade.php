<x-web.layout :title="$page->metaTitle"
              :description="$page->metaDescription"
              :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    @foreach($tags as $tag)
        <a href="{{ route('blogList', ['tag' => $tag->name]) }}">
            <x-utils.badge> {{ $tag->name }}
                <x-slot name="notify">{{ $tag->numOfPosts }}</x-slot>
            </x-utils.badge>

        </a>

    @endforeach

</x-web.layout>