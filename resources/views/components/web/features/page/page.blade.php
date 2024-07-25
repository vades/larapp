<x-web.layout :title="$metaTitle" :description="$metaDescription" :keywords="$keywords">
    <header class="flex flex-col md:flex-row md:items-start mb-4">
        @if(isset($image))
            <figure class="mb-3 md:mr-3">
                <img class="md:max-w-xs border-4 border-skin-muted drop-shadow-lg"
                     src="{{$image}}"
                     alt="{{ $title }}">
            </figure>
        @endif
        <div>
            <h1 class="text-3xl mb-2">{{ $title }}</h1>
            @if(isset($subtitle))
                <h2 class="text-xl mb-2">{{ $subtitle }}</h2>
            @endif
            @if(isset($description))
                <div class="font-bold my-2">{{ $description }}</div>
            @endif
        </div>
    </header>
    <article>
        {!! $content !!}
    </article>
</x-web.layout>