@props(['places'])
<section {{$attributes->class([''])}}>
   @foreach(collect($places)->take(4) as $place)
      <a href="{{ route('placeItem',  ['placeId'=>$place->slug]) }}">
         <h2 class="text-2xl font-bold mb-3">{{ $place->title }}</h2>
      </a>
   @endforeach
</section>