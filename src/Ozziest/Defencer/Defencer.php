<?php namespace Ozziest\Defencer;

/**
 * Defencer
 *
 * @package Ozziest\Defencer
 * @author  Özgür Adem Işıklı <i.ozguradem@gmail.com>
 */
abstract class Defencer {

	/**
	 * Get Defencer
	 *
	 * @return Array
	 */	
	public function getDefencers()
	{
		throw new \RuntimeException("Class does not implement getDefencers method.");		
	}

	/**
	 * Call Magic Method 
	 *
	 * @param  string 		$name 
	 * @param  array 		$arguments 
	 * @return null
	 */
	public function __call($name, $arguments)
	{
		$defencers = (object) $this->getDefencers();
		if (isset($defencers->{$name})) {
			foreach ($defencers->{$name} as $key => $value) {
				$this->callDynamic($value, $arguments);
			}
		}
		call_user_func_array(array($this, '_'.$name), $arguments);
	}

	/**
	 * Call Dynamic
	 *
	 * @param  string 		$directive 
	 * @param  array  		$arguments
	 * @return null
	 */
	private function callDynamic($directive, $arguments) 
	{
		// Solve class structure
		list($alias, $method) = explode('@', $directive);
		// Create new instance or get the instance
		$defence = Loader::getClass($alias, $arguments);
		// Method calling
		$defence->{$method}();
	}

}