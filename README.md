#Out

Helper pour regrouper ces propres les baliles html de bas niveau de type :
> imgZoom, inputDate, inputAjax, nav-bar
Ce qui permet de plus réutiliser son travail et devrais permettre une plus grande indépendance vis a vis des frameworks css.


-----

##Inclus

* helper class Out
* vue de test
* Modeles de micro templates


-----

##Exigences
- Laravel 4

-----

##Installation namuelle

>Note : pour l'instant ce n'est pas un package juste un test de fonctionnalité.



###1) Vues


####1.1) core
 copier le dossier core dans /app/vues/
 > ce ne sont que des templates de bas niveau ou micro templates

####1.2) exemples
 vue /app/views/frontend/pages/home.blade.php
    
###2) Helper
 dans app/start/
 
#### 2.1) copier le fichier Out.php
#### 2.2) dans global.php ajouter ces 2 lignes :
        require_once __dir__.'/Out.php';
        App::register('OutServiceProvider');
>ce helper n'est pas encore un package
    

-----

##Utilisations

###1) directe

On n'utilise pas de helper juste un include

        @include('core.li',array('params'=>array('content'=>'test','href'=>'#')))


###2) Helper

        $out=$app['Out'];
>ce helper n'est qu'un test

html est la méthode la plus générale

        {{	$out->html('li')
			->with('content','test avec with')
			->with('style','color:#d00')
        }}


        {{
		$out->html('ul')
			->add( array('content'=>'ligne1') )
			->add( array('content'=>'ligne2','style'=>'color:#00d') )
			->add( array('content'=>'ligne3') )
			->add( array('content'=>'ligne4','href'=>'#') )
			->with('style','color:#d00')	
        }}

une méthode "txt" plus simple:

        {{ $out->txt('b','je suis en gras') }}