<x-web.layout :title="$page->metaTitle" :description="$page->metaDescription" :keywords="$page->keywords">
    <header class="flex flex-col md:flex-row md:items-start mb-4">
        @if(isset($page->image))
            <figure class="mb-3 md:mr-3">
                <img class="md:max-w-xs border-4 border-skin-muted drop-shadow-lg"
                     src="{{$page->image}}"
                     alt="{{ $page->title }}">
            </figure>
        @endif
        <div>
            <h1 class="text-3xl mb-2">{{ $page->title }}</h1>
            @if(isset($page->subtitle))
                <h2 class="text-xl mb-2">{{ $page->subtitle }}</h2>
            @endif
            @if(isset($page->description))
                <div class="font-bold my-2">{{ $page->description }}</div>
            @endif
        </div>
    </header>
    <article>
        {!! $page->content !!}
    </article>
</x-web.layout>