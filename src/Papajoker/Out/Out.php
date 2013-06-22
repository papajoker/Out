<?php namespace Papajoker\Out;
/**
 *
 *	helper pour utiliser de micro templates blade
 *	templates blade sont dans /views/core/
 *	/core/ peur être un dossier spécifique a un framework css
 *
 *	utilisation dans une vue:
 *	$out->html('li')->with('content','test avec with')->with('style','color:#d00')
 *	ou
 *	@include('core.li',array('params'=>array('content'=>'test','href'=>'#')))
 *
 *	{{ $out->txt('b','je suis en gras') }}
 *
 *	existe que html et txt
 *
 *	mais facile ajouter (si besoin ?)
 *
 *	img imgZoom imgList ...
 *	btn ...
 *	input, inputAjax, inputDate ...
 *
 *	ajouter des templates
 *	nav-bar - menu-item pour indépendance FrameworkCss
 *
 *
 */
 
class Out 
{
  private $template;			// nom du micro template blade
  private $elements=array(); 	// elements inclus dans ->add
  private $params=array();		// parametres ->with

  
  public function __construct()
  {
    $this->elements=array(); 
    $this->params=array('href'=>null,'content'=>'');
    $this->loader= new BladeLoader();
  }

  /**
   *	construction d'une balise html
   *	methode générale pout tout tag html
   *	@return Out lui-meme
   */
  public function html ($templateBlade, Array $params=array() )
  { 
	$this->template=$templateBlade;
	
	if (!array_key_exists('href',$this->params)) $this->params['href']=null;
	if (!array_key_exists('content',$this->params)) $this->params['content']='';
	//if (!isset($this->params['actif'])) $this->params['actif']=false;
	if ($params) {
	  $this->params=self::convertClass($params);	//print_r($this->params);
	}
	return $this;
  }
  
  public function __toString()
  {
    return (String)self::out();
  }

  
  /**
   *	transformation en html avec moteur blade
   *	@return Sting chaine Html
   */
  public function out()
  {
        return \View::make(
	    $this->loader->path($this->template),
	    array('params' => $this->params),
	    array('elements' => $this->elements) // si elements inclus
	);
  }
  
  /**
   * meme resultat que html mais "content" en parametre pour utilisation + simple
   */
  public function txt($templateBlade, $txt, Array $params=null){
      $params['content']=$txt;
      return $this->html($templateBlade,$params);
  }
  
	/**
	 * Appel dynamique a un micro-template
	 * 	Out::li( array() )
	 * 	Out::li('message' )
	 *
	 * @param  string  $method micro-template
	 * @param  array   $parameters
	 * @return String chaine html
	 */
	public function __call($method, $parameters=array() )
	{
	  $this->loader->exist($method);
	  
	  if (count($parameters)>1){
	      $content= array_shift($parameters);
	      $parameters=array_shift($parameters);
	      $parameters['content']=$content;
	  }
	  else{
	    $parameters=array_shift($parameters);
	    $parameters = (is_string($parameters)) ? array('content'=>$parameters) : $parameters;
	  }


	  if (!is_array($parameters)) $parameters=array();
	  return $this->html($method,$parameters);

	}  

  /**
   *	ajoute un sous element au tag
   */
  public function add(Array $params)
  {
	if (!array_key_exists('href',$params)) $params['href']=null;
        if (!array_key_exists('content',$params)) $params['content']='';
	$this->elements[] = $this->convertClass($params);
	return $this;
  }

  /**
   *	ajoute un attribut au tag
   */
  public function with($key,$value){
	$this->params[$key]=$value;
	if ($key=='class') $this->params=$this->convertClass($this->params);
	return $this;
  }

  /**
   *	utilitaire dans vue bas niveau
   *	filtre parametres attibuts
   */
  static public function isAttr($key){
    //content,href dans params : mots reservés
    return (($key!='href')&&($key!='content'));
  }
  
  /**
   *	utilitaire dans vue bas niveau
   */  
  static public function isValid($key,$array){
    if ((!$array)||(!$key)) return false;
    return (	(array_key_exists($key,$array))&&(isset($array[$key]))	);
  }
  
  /**
   *	convertion d'une class générale en class frameworkCss
   *	danger => warning
   */
  protected function convertClass($params)
  {
    $framework= \Config::get('frameworkcss');
    foreach($params as $key=>$value){
      if ($key=='class'){
	 //$convert= Lang::get('frameworkcss.'.$this->$template.'.'.$value);
	 //if ($convert) $params[$key]=$convert;
      }
    }
    return $params;
  }
  
}
