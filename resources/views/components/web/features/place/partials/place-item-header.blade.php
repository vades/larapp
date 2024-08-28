@props(['place'])
<section {{$attributes->class(['sm:flex justify-between gap-8 flex-wrap'])}}>
    @if(isset($place->imageUrl))
        <div class="sm:w-64">
            <figure class="sm:w-64 sm:h-64 sm:p-2">
                <img class="sm:h-full sm:w-full object-cover sm:max-w-[300px] sm:rounded-full sm:border-8 "
                     src="{{ $place->imageUrl }}"
                     alt="{{ $place->title }}">
            </figure>
        </div>
    @endif
    <div class="flex-1">
        <h1 class="text-3xl mt-4">{{ $place->title }}</h1>
        @if(isset($place->subTitle))
            <h2 class="subtitle">{{ $place->subTitle }}</h2>
        @endif

        @if(isset($place->description))
            <div class="perex">{{ $place->description }}</div>
        @endif

        @if(isset($place->address))
            <div class="mb-4"><span class="font-bold">Address:</span> {{ $place->address }}</div>
        @endif
    </div>
    @if(isset($place->googleMapEmbedUrl))
        <div class="w-full basis-full lg:basis-1/3">
            <x-utils.iframe :src="$place->googleMapEmbedUrl" />
        </div>
    @endif
</section>