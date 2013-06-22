@extends('frontend/layouts/default')

<!-- Traduction Laravel-france  -->
<!-- Maj:7/06/2013 - frontend/pages/home.php -->

{{-- Page title --}}
@section('title')
{{Lang::get('frontend/pages.home.title')}}
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>{{Lang::get('frontend/pages.home.description')}}</h3>
		
		
	--------------------------<br>
<h2>Test du helper Out</h2>	
	
<?php
Out::isValid('a', array() );

$out=$app['Out'];
var_dump($out);
//print_r(\Config::getItems());
?>
	
	<br>
	{{	$out->html('li',array('content'=>'test','class'=>'center','style'=>'font-size:140%'))	 }}
	<br>
	{{	$out->html('li')
			->with('content','test avec with')
			->with('style','color:#d00')
	}}
	
	
	<hr>
	<h3>utilisation directe</h3>
	@include('core.test')
	<br><i>include('core.li',array('params'=>array('content'=>'test avec lien','href'=>'#')))</i>
	<br>@include('core.li',array('params'=>array('content'=>'test','href'=>'#')))
	<br><i>include('core.li',array('params'=>array('content'=>'test sans lien')))</i>
	<br>@include('core.li',array('params'=>array('content'=>'test sans lien')))

	<br>test d'un strong:
	{{ $out->txt('b','je suis en gras') }}
	
	
	<br>test d'un ul:
	{{
		$out->html('ul')
			->add( array('content'=>'ligne1') )
			->add( array('content'=>'ligne2','style'=>'color:#00d') )
			->add( array('content'=>'ligne3') )
			->add( array('content'=>'ligne4','href'=>'#') )
			->with('style','color:#d00')
	
	}}
	
	<br>tests dynamiques
	{{	$out->li( 'appel a liTxt(string)' )	}}
	{{	$out->li( array('content'=>'appel a li(array)') )	}}
	
	{{	$out->li( 'appel a liTxt(string)',array('style'=>'color:#0c0') )	}}
	{{
		$out->li( 'appel a liTxt(string)',array('class'=>'strong') )
			->with('style','color:#990')
	}}
	{{	$out->li( array('content'=>'appel a li(array)','style'=>'color:#00c') )	}}
	<hr>
        {{ $out->li('je suis une puce') }}
        {{ $out->li('je suis une puce' , array('class'=>'o') )  }}        
        {{ $out->ulOpen(  array('class'=>'o') ) }}
        {{ $out->ulClose() }} 	
	
	
	
	
</div>

@stop
