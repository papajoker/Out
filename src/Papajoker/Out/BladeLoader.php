<?php namespace Papajoker\Out;
/**
 *
 *	Chargement des micro templates blade
 *	avec gestion d'un theme
 *	templates blade sont dans /views/theme/core/
 *	/core/ peut être un dossier spécifique a un framework css
 *
 *	si template non trouvé charge la template du theme par defaut
 *
 */
 
class BladeLoader 
{
  private $path;		// nom du micro template blade
  private $theme='bootstrap2'; 	// dossier theme frameworkcss::
  static private $themedefault='bootstrap2'; // si template non trouvé
  

  public function __construct()
  {
    $this->setTheme();
  }
  
  /**
   * vérification si utilisation d'un theme ()frameworkcss
   */  
  private function setTheme()
  {
    $this->theme=\Session::get('theme');		 // \Config::get('theme')?
    $this->path= ($this->theme) ? $this->theme.'/' : ''; // static::$themedefault;
    $this->path.='core/';    
  }
  
  /**
   * verification si micro template existe
   */
  public function exist($template)
  {
    $this->setTheme();
    $template=base_path().'/app/views/'.$this->path.$template.'.blade.php';
    /*
     *@todo utiliser un package Framework css
     *$template=base_path().'/public/packages/'.$this->theme.'/views/'.$this->path.$template.'.blade.php';
     */
    if (!file_exists($template)){
        /**
	* theme par defaut ce qui permet de n'avoir que les micro-templates particulières dans autres frameworks
	*/
	$template=base_path().'/app/views/'.static::$themedefault.'/core/'.$template.'.blade.php';
	if (!file_exists($template))
	    throw new Exception('Micro template not found! '.$template);
	else{
	  // changement de theme dynamique
	  $this->theme= static::$themedefault;
	}
    }
    return true;
  }
  
  /**
   * retourne parametre passé a la methode View::make()
   * @return String path pour view::make()
   */
  public function path($template)
  {
    return $this->path.$template;
    /*
     *@todo utiliser un package Framework css
     * mais que faire : \View::make( PATH ?? ); frameworkcss::core/li
     */  
  }

  
  public function __toString()
  {
    return $this->path;
  }
  
  public function getTheme(){
    return $this->theme;
  }

  
}
