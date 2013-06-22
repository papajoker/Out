
<?php
 //var_dump($elements);
?>
<ul @foreach ($params as $key=>$value) @if (Out::isAttr($key)){{$key}}="{{$value}}"@endif @endforeach >
	@foreach($elements as $element)
		@include('core.li',array('params'=>$element) )
	@endforeach
</ul>
