<?php
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Util\Container\Map\StorageMap;

/**
 * RegistryMap 
 * 
 * @uses StorageMap 
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class RegistryMap extends StorageMap implements Registry 
{
	/**
	 * initContainer 
	 * 
	 * @param mixed $values 
	 * @access protected
	 * @return void
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer(array());

		foreach($values as $key => $value) {
			$this->set($key, $value);
		}
	}

	/**
	 * initRegistry 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initRegistry()
	{
	}
}
