<span class="{{$classList}}">
@if(file_exists($img))
        {!! file_get_contents($img) !!}
    @endif
</span>
