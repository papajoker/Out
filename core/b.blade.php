<strong @foreach ($params as $key=>$value) @if (Out::isAttr($key)) {{$key}}="{{$value}}"@endif@endforeach >
@if (out::isValid('href',$params))<a href="{{$params['href']}}">@endif
{{$params['content']}}
@if (out::isValid('href',$params))</a>@endif
</strong>