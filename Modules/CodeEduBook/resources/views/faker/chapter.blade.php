# {{$title}}

@foreach($contents as $content)
##{{$content['subtitle']}}
{{$content['content']}}
@endforeach