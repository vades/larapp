@props(['posts'])
<section {{$attributes->class([''])}}>
   @foreach(collect($posts)->take(4) as $post)
      <a href="{{ route('blogItem',  ['postId'=>$post->slug]) }}">
         <h2 class="text-2xl font-bold mb-3">{{ $post->title }}</h2>
      </a>
   @endforeach
</section>