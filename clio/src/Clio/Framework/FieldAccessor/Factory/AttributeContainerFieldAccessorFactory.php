<?php
namespace Clio\Framework\FieldAccessor\Factory;

use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping;
use Clio\Component\Pce\FieldAccessor\Factory\FieldAccessorFactory;
use Clio\Framework\FieldAccessor\AttributeContainerFieldAccessor;


class AttributeContainerFieldAccessorFactory implements FieldAccessorFactory 
{
	/**
	 * createFieldAccessor 
	 * 
	 * @param ClassMapping $mapping 
	 * @access public
	 * @return void
	 */
	public function createFieldAccessor(ClassMapping $mapping)
	{
		return new AttributeContainerFieldAccessor($mapping);
	}
}

