<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
    <section class="sm:grid sm:grid-cols-2 sm:gap-2 md:gap-3 md:grid-cols-3 lg:grid-cols-4">
        @foreach($posts as $post)
            <x-web.features.blog.partials.blog-list-card :post="$post" />
            <x-utils.card>
                <x-slot name="header">
                    <img class="mr-auto ml-auto" src="{{$post->imageUrl}}" alt="{{ $post->title}}">
                </x-slot>
                <x-slot name="body">
                    <h2>{{ $post->title }}</h2>
                    <div>
                        {{ $post->content }}
                    </div>
                </x-slot>
                <x-slot name="footer">
                    <a href="" class="btn btn-primary">Read More</a>
                </x-slot>
            </x-utils.card>
        @endforeach
    </section>
    <x-utils.pagination />
</x-web.layout>