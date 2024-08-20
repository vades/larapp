
@props(['images'])
<section {{$attributes->class(['grid grid-cols-2 gap-2 md:grid-cols-4 lg:grid-cols-5'])}}>
   @foreach($images as $image)
   <figure class="cursor-pointer">
      <img class="h-auto max-w-full rounded" src="{{ $image->thumbnail }}" alt="{{ $image->title }}"/>
   </figure>
   @endforeach
</section>