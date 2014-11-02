<?php
namespace Clio\Component\Util\Injection;

/**
 * AbstractInjector 
 * 
 * @uses Injector
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractInjector implements Injector
{
	/**
	 * {@inheritdoc}
	 */
	public function inject($object, $throwable = true)
	{
		try {
			$refObject = new \ReflectionObject($object);
			$this->doInject($refObject, $object);

		} catch(InjectionException $ex) {
			if($throwable) {
				throw $ex;
			}
		}
	}

	/**
	 * doInject 
	 * 
	 * @param mixed $refObject 
	 * @param mixed $object 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doInject($refObject, $object);
}

