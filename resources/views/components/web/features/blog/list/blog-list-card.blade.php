<x-utils.card class="bg-skin-base">
    <x-slot name="header">
        <img class="mr-auto ml-auto"
             src="{{$post->imageUrl}}"
             alt="{{ $post->title}}">
    </x-slot>
    <x-slot name="body" class="p-3">
        <h2 class="text-2xl font-bold mb-3">{{ $post->title }}</h2>
        <div class="mb-3">
            {{ $post->description }}
        </div>
    </x-slot>
    <x-slot name="footer" class="p-3">
        <div>
            <span class="btn btn-primary">Read More</span>
        </div>
    </x-slot>
</x-utils.card>