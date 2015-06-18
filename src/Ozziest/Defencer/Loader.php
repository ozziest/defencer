<?php namespace Ozziest\Defencer;

/**
 * Loader
 *
 * @package Ozziest\Defencer
 * @author  Özgür Adem Işıklı <i.ozguradem@gmail.com>
 */
class Loader {

	/** 
	 * Loaded 
	 *
	 * @var  array
	 */
	private static $loaded = array();

	/**
	 * Get Class 
	 *
	 * @param  string $name
	 * @param  array  $arguments
	 * @return object
	 */
	public static function getClass($name, $arguments = array())
	{
		// instance checking..
		if (!isset(self::$loaded[$name])) {
			// Creating new instance
			self::$loaded[$name] = new $name;
			// Calling init method
			self::$loaded[$name]->init($arguments);
		}
		// Return instance
		return self::$loaded[$name];
	}

}