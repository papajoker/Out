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

##Installation 

faire un composer update papajoker/out

dans config/app.php

ajouter dans  [providers]
`'Papajoker\Out\OutServiceProvider',`

ajouter dans  [aliases]
`'Out'=> 'Papajoker\Out\Facades\Out',`


###1) Vues


####1.1) core
 copier le dossier core dans `/app/vues/`
 > ce ne sont que des templates de bas niveau ou micro templates

   

-----

##Utilisations

###1) directe :(

On n'utilise pas le helper juste un include
 `@include('core.li',array('params'=>array('content'=>'test','href'=>'#')))`


###2) Helper



html est la méthode la plus générale

        {{	Out::html('li')
			->with('content','test avec with')
			->with('style','color:#d00')
        }}


        {{
		Out::html('ul')
			->add( array('content'=>'ligne1') )
			->add( array('content'=>'ligne2','style'=>'color:#00d') )
			->add( array('content'=>'ligne3') )
			->add( array('content'=>'ligne4','href'=>'#') )
			->with('style','color:#d00')	
        }}

la méthode dynamique plus simple:
> le nom de la méthode est celui du template

        {{ Out::li('je suis une puce') }}
        {{ Out::li('je suis une puce')->with('class'=>'o')  }}         
        {{ Out::li('je suis une puce' , array('class'=>'o') )  }}        
        {{ Out::ulOpen(  array('class'=>'o') ) }}
        {{ Out::ulClose() }}        