<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Framework\Registry;

use Clio\Component\Pattern\Registry\AbstractRegistry;
/**
 * ServiceRegistry
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class ServiceRegistry extends AbstractRegistry implements ServiceRegistryInterface 
{
	protected function isValidValue($value)
	{
		return $this->isValidService($value);
	}

	protected function isValidService($service)
	{
		return is_object($service);
	}
}

