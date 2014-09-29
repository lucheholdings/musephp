<?php
namespace Clio\Component\Pce\FieldAccessor\Factory;

use Clio\Component\Util\Container\Collection\ObjectCollection;

class TypePropertyFieldAccessorFactory extends ObjectCollection
{
	/**
	 * addDefaultFactories 
	 * 
	 * @param TypedFieldAccessorFactory $factory 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function addDefaultFactories(TypedFieldAccessorFactory $factory)
	{
		$factory
			->setFieldAccessorFactory('public_property', new FieldAccessorComponentFactory('Clio\Component\Pce\FieldAccessor\Property\PublicPropertyFieldAccessor'))
			->setFieldAccessorFactory('method', new FieldAccessorComponentFactory('Clio\Component\Pce\FieldAccessor\Property\MethodPropertyFieldAccessor'))
		;
	}

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setValidateClass('Clio\Component\Pce\FieldAccessor\Factory\FieldAccessorFactoryInterface');
	}

	/**
	 * setFieldAccessor 
	 * 
	 * @param mixed $type 
	 * @param $ $$ 
	 * @access public
	 * @return void
	 */
	public function setFieldAccessorFactory($type, FieldAccessorFactoryInterface $factory)
	{
		$this->set($type, $factory);
		return $this;
	}

	/**
	 * getFieldAccessor 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function getFieldAccessorFactory($type)
	{
		return $this->get($type);
	}
	
	/**
	 * createTypedFieldAccessor 
	 * 
	 * @param mixed $type 
	 * @param mixed $classMapping 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function createTypedFieldAccessor($type, $classMapping, $field)
	{
		$factory = $this->getFieldAccessorFactory($type);

		return $factory->createFieldAccessor($classMapping, $field);
	}

}

