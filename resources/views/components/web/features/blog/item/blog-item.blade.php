<x-web.layout :title="$post->metaTitle ?? null" :description="$post->metaDescription ?? null" :keywords="$post->keywords ?? null">
    <x-web.partials.page-header :page="$post" />
    <div class="text-sm mb-3">
        <span class="mr-2">{{implode(', ', $post->authors)}}</span>
        <span class="posts-date">{{ \Carbon\Carbon::parse($post->createdAt)->format('Y-m-d') }}</span>
    </div>
    <article>
        {!! $post->content !!}
    </article>
    <section>
        <x-utils.prev-next class="flex justify-center mt-8" prevUrl="#" nextUrl="#"/>
    </section>
</x-web.layout>