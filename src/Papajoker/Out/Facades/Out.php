<?php namespace Papajoker\Out\Facades;

use Illuminate\Support\Facades\Facade;

class Out extends Facade {
    
    /*protected static $instance;

    public static function instance()
    {
		if (static::$instance === null)
		{
			static::$instance = new Papajoker\Out\Out();
		}

		return static::$instance;
    }
    
    public static function __callStatic($method, $args)
    {
	$instance = static::instance();
	return call_user_func_array(array($instance, $method), $args);
    }
    ------------------------------------------------
    */
    
    /**
    * Get the registered name of the component.
    *
    * @return string
    */
    protected static function getFacadeAccessor() { return 'out'; }    
}
