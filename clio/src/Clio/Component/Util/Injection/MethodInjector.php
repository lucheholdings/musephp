<?php
namespace Clio\Component\Util\Injection;

class MethodInjector extends AbstractInjector 
{
	/**
	 * methodName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $methodName;

	/**
	 * args 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $args;

	/**
	 * __construct 
	 * 
	 * @param mixed $methodName 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function __construct($methodName, array $args = array())
	{
		$this->methodName = $methodName;
		$this->args = $args;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doInject($refObject, $object)
	{
		if(!$refObject->hasMethod($this->methodName)) {
			throw new InjectionException(sprintf('Method "%s::%s" dose not exist.', $refObject->getName(), $this->methodName));
		}

		$refMethod = $refObject->getMethod($this->methodName);

		if(!$refMethod->isPublic()) {
			throw new InjectionException('Method "%s::%s" is not a public method.', $refObject->getName(), $refMethod->getName());
		}

		//
		$refMethod->invokeArgs($object, $this->args);
	}
}

