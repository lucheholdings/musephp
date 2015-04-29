<?php
namespace ;

/**
 * Class 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FactoryCollection
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function createAdapter($validator)
	{
		foreach($this as $factory) {
			if($factory->supports($validator)) {
				return $factory->createAdapter($validator);		
			}
		}

		throw new \Exception('Not Supported.');
	}
}

