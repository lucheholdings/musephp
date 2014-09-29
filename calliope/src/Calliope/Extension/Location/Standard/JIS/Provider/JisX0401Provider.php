<?php
namespace Calliope\Extension\Location\Standard\JIS\Provider;

/**
 * JisX0401Provider 
 * 
 * @uses LocationProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class JisX0401Provider extends LocationProvider
{
	public function code($code)
	{
		
	}

	public function getIterator()
	{
		if(!$this->_loaded) {
			$this->_load();	
		};

		return $this->_loaded->getIterator();
	}

	public function get($code)
	{
		return $locationProvider->findOneBy(array('jis_x_0401' => ''));
	}
}
