<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Util\Accessor\ChainProxySchemaAccessor;

/**
 * ClassAccessorFactoryCollection
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassAccessorFactoryCollection extends FactoryCollection implements ClassAccessorFactory 
{
	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args)
	{
		$classReflector = array_shift($args);
		$options = array_shift($args);

		return $this->creaetClassAccessor($classReflector, $options);
	}

	/**
	 * createClassAccessor 
	 * 
	 * @param mixed $class 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createClassAccessor($class, array $options = array())
	{
		$accessor = null;
		foreach($this->getFactories() as $factory) {
			if($accessor) {
				$decorateAccessor = $factory->createClassAccessor($class, $options);
				$accessor = new ChainProxySchemaAccessor($decorateAccessor, $accessor);
			} else {
				$accessor = $factory->createClassAccessor($class, $options);
			}
		}

		return $accessor;
	}

	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args)
	{
		$class = array_shift($args);
		$options = array_shift($args);
		return $this->createClassAccessor($class, $options);
	}

	/**
	 * createClassAccessor 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function createClassAccessor($class, array $options = array())
	{
		$accessor = parent::createClassAccessor($class, $options);

		return new 
		
		$decorator = $this->createDecorator();

		if($class instanceof \ReflectionClass) {
			$classReflector = $class;
		} else if(is_object($class)) {
			$classReflector = new \ReflectionClass($class);
		} else {
			throw new \InvalidArgumentException(sprintf('createClassAccessor only accept a ReflectionClass or an instance, but %s is given.', gettype($class)));
		}

		$fields = $this->createFieldAccessors($classReflector);
		return new SimpleClassAccessor($classReflector, $fields, $options);
	}

	/**
	 * createFieldAccessors 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @access public
	 * @return void
	 */
	public function createFieldAccessors(\ReflectionClass $classReflector)
	{
		$fields = array();
		foreach($classReflector->getProperties() as $property) {
			$fields[$property->getName()] = $this->getFieldAccessorFactory()->createClassFieldAccessor($classReflector, $property->getName());
		}

		return $fields;
	}
    
    public function getFieldAccessorFactory()
    {
        return $this->fieldAccessorFactory;
    }
    
    public function setFieldAccessorFactory(FieldAccessorFactoryCollection $fieldAccessorFactory)
    {
        $this->fieldAccessorFactory = $fieldAccessorFactory;
        return $this;
    }
}

