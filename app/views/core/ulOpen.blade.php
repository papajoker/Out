<ul @foreach ($params as $key=>$value) @if (Out::isAttr($key)){{$key}}="{{$value}}"@endif @endforeach >

