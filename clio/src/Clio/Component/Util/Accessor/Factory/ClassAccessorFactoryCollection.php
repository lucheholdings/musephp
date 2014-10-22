<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Util\Accessor\ChainProxySchemaAccessor;

/**
 * ClassAccessorFactoryCollection
 *   Support Composite pattern of Accessor Factory.
 *
 *   Call creaetClassAccessor() to create ChainedProxySchemaAccessor 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassAccessorFactoryCollection extends FactoryCollection implements ClassAccessorFactory 
{
	protected function initContainer()
	{
		$this->setValueValidator(new ClassValidator('Clio\Component\Util\Accessor\Factory\ClassAccessorFactory'));
	}

	/**
	 * createClassAccessor 
	 *    Create an instance which Chained all created accessor 
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
				if(!$accessor instanceof ChainProxySchemaAccessor) {
					$accessor = new ChainProxySchemaAccessor($accessor);
				}
				$accessor->setNext($factory->createClassAccessor($class, $options));
			} else {
				$accessor = $factory->createClassAccessor($class, $options);
			}
		}

		return $accessor;
	}
}
