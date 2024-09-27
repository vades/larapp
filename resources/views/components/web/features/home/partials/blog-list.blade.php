@inject('carbon', 'Carbon\Carbon')
@props(['posts'])
<section {{$attributes->class(['md:grid md:grid-cols-2 md:gap-4'])}}>
    @foreach($posts as $item)
        <a href="{{ route('blogItem',  ['postId'=>$item->slug]) }}">
            <x-utils.panel class="bg-skin-base">
                <x-slot name="header">
                    <figure class="mb-3 md:mr-3">
                        <img src="{{$item->image_url}}"
                             alt="{{ $item->title}}">
                    </figure>

                </x-slot>
                <x-slot name="body"
                        class="p-3">
                    <div class="mb-3">{{ $carbon::parse($item->created_at)->format('Y-m-d') }}</div>
                    <h3 class="text-lg mb-3">{{ $item->title }}</h3>
                    <div class="mb-3">{{ $item->description }}</div>
                </x-slot>
            </x-utils.panel>
        </a>
    @endforeach
</section>