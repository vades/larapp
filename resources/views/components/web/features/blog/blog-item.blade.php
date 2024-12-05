@inject('carbon', 'Carbon\Carbon')
<x-web.layout :title="$post->metaTitle ?? null" :description="$post->metaDescription ?? null" :keywords="$post->keywords ?? null">
    <x-utils.page-header class="text-skin-blog">
        <x-slot name="image">
            <img class="md:max-w-xs border-4 border-skin-muted drop-shadow-lg"
                 src="{{$post->image_url}}"
                 alt="{{ $post->title }}">
        </x-slot>
        <x-slot name="title" class="text-skin-blog">
            {{ $post->title }}
        </x-slot>
        <x-slot name="subtitle">
            {{ $post->subTitle ?? null }}
        </x-slot>
        <x-slot name="description">
            {{ $post->description ?? null }}
        </x-slot>
        <x-slot name="info">
            <span class="mr-2">{{$post->user->name}}</span>
            <span class="posts-date">{{ $carbon::parse($post->createdAt)->format('Y-m-d') }}</span>
        </x-slot>
    </x-utils.page-header>
    <article class="text-skin-blog">
        {!! $post->content !!}
    </article>
    @if(isset($post->inTags))
        <section class="mt-4">
            @foreach($post->inTags as $tag)
                <a href="{{ route('blogList', ['tag' => $tag]) }}">
                    <x-utils.badge>{{ $tag }}</x-utils.badge>
                </a>
            @endforeach
        </section>
    @endif
    <section>
        <x-utils.prev-next class="flex justify-center mt-8" prevUrl="#" nextUrl="#"/>

    </section>
</x-web.layout>