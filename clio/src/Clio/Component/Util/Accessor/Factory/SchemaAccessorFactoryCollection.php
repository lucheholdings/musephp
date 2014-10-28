<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Util\Accessor\SchemaAccessorFactory;
use Clio\Component\Pattern\Factory\FactoryCollection;
use Clio\Component\Util\Accessor\ChainProxySchemaAccessor;
use Clio\Component\Util\Validator\ClassValidator;

/**
 * SchemaAccessorFactoryCollection
 *   Support Composite pattern of Accessor Factory.
 *
 *   Call creaetSchemaAccessor() to create ChainedProxySchemaAccessor 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaAccessorFactoryCollection extends FactoryCollection implements SchemaAccessorFactory 
{
	protected function initContainer()
	{
		$this->setValueValidator(new ClassValidator('Clio\Component\Util\Accessor\SchemaAccessorFactory'));
	}

	/**
	 * createSchemaAccessor 
	 *    Create an instance which Chained all created accessor 
	 * @param mixed $class 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createSchemaAccessor($schema, array $options = array())
	{
		$accessor = null;
		foreach($this->getFactoriesReversed() as $factory) {
			if($accessor) {
				$accessor = new ChainProxySchemaAccessor(
						$factory->createSchemaAccessor($class, $options),
						$accessor
					);
			} else {
				$accessor = $factory->createSchemaAccessor($class, $options);
			}
		}

		return $accessor;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($key, array $args = array())
	{
		return $this->isSupportedSchema($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedSchema($schema)
	{
		foreach($this->getFactories() as $factory) {
			if($factory->isSupportedSchema($schema)) {
				return true;
			}
		}
		return false;
	}
}
