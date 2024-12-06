<x-web.layout :title="$page->metaTitle"
              :description="$page->metaDescription"
              :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    @foreach($tags as $tag)
        <a href="{{ route('blogList', ['tag' => $tag->name]) }}">
            <x-utils.badge class="block w-full sm:inline-block sm:w-1/5 mb-2 sm:mr-2" > {{ $tag->name }}
                <x-slot name="notify">{{ $tag->posts_count }}</x-slot>
            </x-utils.badge>

        </a>

    @endforeach

</x-web.layout>