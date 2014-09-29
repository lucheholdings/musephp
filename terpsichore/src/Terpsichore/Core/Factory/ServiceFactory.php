<?php
namespace Terpsichore\Core\Factory;

use Clio\Component\Pattern\Factory\InheritComponentFactory;

class ServiceFactory extends InheritComponentFactory 
{
	const DEFAULT_INTERFACE = 'Terpsichore\Core\Service';

	public function __construct($baseClass = null)
	{
		if($baseClass) {
			// validate the class is a subclass of DEFAULT_CLASS
			if(!is_subclass_of($baseClass, self::DEFAULT_INTERFACE)) {
				throw new \InvalidArgumentException(sprintf(
					'Class "%s" is not a valid subclass of "%s"',
					$baseClass, 
					self::DEFAULT_INTERFACE
				));
			}
		} else {
			$baseClass = self::DEFAULT_INTERFACE;
		}

		parent::__construct($baseClass);
	}
}

