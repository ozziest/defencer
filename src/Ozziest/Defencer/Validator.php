<?php namespace Ozziest\Defencer;

/**
 * Validator
 *
 * @package Ozziest\Defencer
 * @author  Özgür Adem Işıklı <i.ozguradem@gmail.com>
 */
abstract class Validator {

	/**
	 * Construct 
	 * 
	 * @return null
	 */
	public final function __construct() 
	{
		if(!isset($this->fields)) {
			throw new \RuntimeException(get_class($this) . ' must have a $fields array.');
		}
	}

	/**
	 * Init 
	 * 
	 * @param  array $arguments
	 * @return null
	 */
	public function init($arguments)
	{
		if (isset($this->fields) && is_array($this->fields)) {
			foreach ($this->fields as $key => $value) {
				$this->{$value} = null;
			}
			foreach ($this->fields as $key => $value) {
				if (isset($arguments[$key])) {			
					$this->{$value} = $arguments[$key];
				}
			}
		} else {
			$this->arguments = $arguments;
		}
	}		

}