<?php
namespace Clio\Component\Injection;

/**
 * ClassInjector 
 * 
 * @uses Injector
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassInjector extends MethodInjector implements Injector 
{
	/**
	 * class 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $refClass;

	/**
	 * strict 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $strict;

	/**
	 * __construct 
	 * 
	 * @param mixed $refClass Class or Interface name 
	 * @param mixed $methodName Method name to call 
	 * @param array $args Arguments for method 
	 * @access public
	 * @return void
	 */
	public function __construct($refClass, $methodName, array $args = array(), $strict = false)
	{
		parent::__construct($methodName, $args);

		$this->refClass = new \ReflectionClass($refClass);
		$this->strict = $strict;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doInject($refObject, $object)
	{
		if(!$this->getReflectionClass()->isInstance($object)) {
			if($this->isStrict()) {
				throw new InjectionException(sprintf('Object "%s" is not an instance of "%s"', get_class($object), $this->getReflectionClass()->getName())); 
			}

			return $object;
		}

		
		parent::doInject($refObject, $object);
	}

	/**
	 * getReflectionClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getReflectionClass()
	{
		return $this->refClass;
	}

	/**
	 * isStrict 
	 * 
	 * @access public
	 * @return void
	 */
	public function isStrict()
	{
		return $this->strict;
	}
}

