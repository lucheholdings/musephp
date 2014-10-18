<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\Field\Factory\ClassFieldAccessorFactory;
use Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection;
use Clio\Component\Util\Accessor\Field\Factory\PublicPropertyFieldAccessorFactory,
	Clio\Component\Util\Accessor\Field\Factory\MethodFieldAccessorFactory
;
use Clio\Component\Util\Accessor\SimpleClassAccessor;

/**
 * BasicClassAccessorFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicClassAccessorFactory extends AbstractFactory 
{
	static public function createDefaultFactory()
	{
		return new static(new FieldAccessorFactoryCollection(array(
			new PublicPropertyFieldAccessorFactory(),
			new MethodFieldAccessorFactory(),
		)));
	}

	/**
	 * fieldAccessorFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldAccessorFactory;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(FieldAccessorFactoryCollection $fieldAccessorFactory)
	{
		$this->fieldAccessorFactory = $fieldAccessorFactory;
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

