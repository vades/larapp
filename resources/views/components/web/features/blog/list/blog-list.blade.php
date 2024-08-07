<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <x-web.partials.page-header :page="$page" />
     <section class="sm:grid sm:grid-cols-2 sm:gap-2 md:gap-3 md:grid-cols-3 lg:grid-cols-4">
        @foreach($posts as $post)
            <a href="{{ route('blogItem',  ['postId'=>'post-id']) }}">
                <x-web.features.blog.list.blog-list-card :post="$post" />
            </a>

        @endforeach
    </section>
    <section>
        <x-utils.pagination class="flex justify-center mt-8" />
    </section>
</x-web.layout>