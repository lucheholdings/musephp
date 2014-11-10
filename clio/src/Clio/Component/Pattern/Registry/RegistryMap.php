<?php
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Util\Container\Map\Map;

class RegistryMap extends Map implements Registry 
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
