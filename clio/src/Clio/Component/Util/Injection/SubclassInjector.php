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
		if(!$refObject->isSubclassOf($this->getReflectionClass())) {
			if($this->isStrict()) {
				throw new InjectionException(sprintf('Object "%s" dose not implement or is not a subclass of "%s"', get_class($object), $this->getReflectionClass()->getName())); 
			}
			return $object;
		}

		parent::doInject($refObject, $object);
	}
}

