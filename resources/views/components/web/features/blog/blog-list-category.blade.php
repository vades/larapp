<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section class="sm:grid sm:grid-cols-2 sm:gap-2 md:gap-3 md:grid-cols-3 lg:grid-cols-4">
        @foreach($categories as $category)
            @php($numOfPosts = count($category->posts))
            <a href="{{ route('blogList', ['category' => $category->slug]) }}">
                <x-utils.card class="bg-skin-base">
                    <x-slot name="header">
                        <img class="mr-auto ml-auto"
                             src="{{$category->image_url}}"
                             alt="{{ $category->title}}">
                    </x-slot>
                    <x-slot name="body" class="p-3">
                        <h2 class="text-2xl font-bold mb-3">{{ $category->title }}</h2>
                        <div class="mb-3">
                            {{ $category->description }}
                        </div>
                    </x-slot>
                    <x-slot name="footer" class="p-3">
                        <div>
                            <span class="btn btn-primary">Show ({{ $numOfPosts }}) articles</span>
                        </div>
                    </x-slot>
                </x-utils.card>
            </a>

        @endforeach
    </section>
</x-web.layout>