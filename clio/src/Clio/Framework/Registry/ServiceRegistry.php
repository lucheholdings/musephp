<?php
namespace Clio\Framework\Registry;

use Clio\Component\Pattern\Registry\MapRegistry;

/**
 * ServiceRegistry
 *   Registry for instance 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class ServiceRegistry extends MapRegistry implements ServiceRegistryInterface 
{
	/**
	 * isValidValue 
	 * 
	 * @param mixed $value 
	 * @access protected
	 * @return void
	 */
	protected function isValidValue($value)
	{
		return $this->isValidService($value);
	}

	/**
	 * isValidService 
	 * 
	 * @param mixed $service 
	 * @access protected
	 * @return void
	 */
	protected function isValidService($service)
	{
		return is_object($service);
	}
}

