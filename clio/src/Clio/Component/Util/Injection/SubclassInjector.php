<?php
namespace Clio\Component\Util\Injection;

/**
 * Subclass 
 * 
 * @uses Injector
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SubclassInjector extends ClassInjector implements Injector 
{
	/**
	 * {@inheritdoc}
	 */
	protected function doInject($refObject, $object)
	{
		if($this->getReflectionClass()->isSubclassOf($object)) {
			throw new InjectionException('Object "%s" dose not implement or is not a subclass of "%s"', get_class($object), $this->getReflectionClass()->getName()); 
		}

		parent::doInject($refObject, object);
	}
}

