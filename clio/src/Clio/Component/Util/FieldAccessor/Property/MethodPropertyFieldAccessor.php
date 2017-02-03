<?php
namespace Clio\Component\Util\FieldAccessor\Property;

use Clio\Component\Util\FieldAccessor\Mapping\ClassMapping;
use Clio\Component\Util\Psr\Psr;

/**
 * MethodFieldAccessor
 * 
 * @uses FieldPropertyAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MethodPropertyFieldAccessor extends AbstractPropertyFieldAccessor 
{
	/**
	 * getter 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $getter;

	/**
	 * setter 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $setter;

	/**
	 * __construct 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param mixed $field 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMapping $classMapping, $field, array $options = array())
	{
		parent::__construct($classMapping, $field, $options);

		if(isset($options['getter'])) {
			if(!$this->getClassMapping()->getReflectionClass()->hasMethod($options['getter'])) {
				throw new \Clio\Component\Exception\Exception('Method "%s::%s" is not exixts', $this->getClassMapping()->getReflectionClass()->getName(), $options['getter']);
			} else {
				$this->getter = $this->getClassMapping()->getReflectionClass()->getMethod($options['getter']);
			}
		}

		if(isset($options['setter'])) {
			if(!$this->getClassMapping()->getReflectionClass()->hasMethod($options['setter'])) {
				throw new \Clio\Component\Exception\Exception('Method "%s::%s" is not exixts', $this->getClassMapping()->getName(), $options['setter']);
			} else {
				$this->setter = $this->getClassMapping()->getReflectionClass()->getMethod($options['setter']);
			}
		}
	}

	/**
	 * setValue 
	 * 
	 * @param mixed $object 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setValue($object, $value)
	{
		$method = $this->getSetter($object);

		return $method->invoke($object, $value);
	}

	/**
	 * getValue 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getValue($object)
	{
		$method = $this->getGetter($object);

		return $method->invoke($object);
	}

	public function isSupportMethod($object, $field, $type)
	{
		$isSupport = false;

		if($field == $this->getField()) {
			switch($type) {
			case self::METHOD_TYPE_GET:
			case self::METHOD_TYPE_IS_NULL:
				$isSupport = (bool)$this->getGetter();
				break;
			case self::METHOD_TYPE_SET:
			case self::METHOD_TYPE_CLEAR:
				$isSupport = (bool)$this->getSetter();
				break;
			default:
				break;
			}
		}

		return $isSupport;
	}

	protected function getGetter()
	{
		if(!$this->getter) {
			$field = $this->getField();
			$method = $getMethod = Psr::methodName('get ' . $field);

			if(!$this->getClassMapping()->getReflectionClass()->hasMethod($method)) {
				$method = $isMethod = Psr::methodName('is ' . $field);
				if(!$this->getClassMapping()->getReflectionClass()->hasMethod($method)) {
					throw new \Clio\Component\Exception\RuntimeException(sprintf('Method "%s" or "%s" is not exsits on Class "%s".', $getMethod, $isMethod, $this->getClassMapping()->getReflectionClass()->getNamespaceName()));
				}
			}
	
			$this->getter = $this->getClassMapping()->getReflectionClass()->getMethod($method);
		}

		return $this->getter;
	}

	protected function getSetter()
	{
		if(!$this->setter) {
			$method = Psr::methodName('set ' . $this->getField());

			if(!$this->getClassMapping()->getReflectionClass()->hasMethod($method)) {
				throw new \Clio\Component\Exception\RuntimeException(sprintf('Method "%s" is not exists.', $method));
			}
	
			$this->setter = $this->getClassMapping()->getReflectionClass()->getMethod($method);
		}

		return $this->setter;
	}
}

