<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\Schema\AccessorFactory as SchemaAccessorFactory;
use Clio\Component\Pattern\Factory\NamedCollection;
use Clio\Component\Util\Accessor\ChainProxySchemaAccessor;
use Clio\Component\Util\Validator\SubclassValidator;

/**
 * Collection 
 *   Support Composite pattern of Accessor Factory.
 *
 *   Call creaetSchemaAccessor() to create ChainedProxySchemaAccessor 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Collection extends NamedCollection implements SchemaAccessorFactory 
{
	protected function initFactory()
	{
		$this->getStorage()->setValueValidator(new SubclassValidator('Clio\Component\Util\Accessor\Schema\AccessorFactory'));
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($type, array $args = array())
	{
		return $this->getFactory($type)->isSupportedSchema(array_shift($args), $args);
	}

	/**
	 * createSchemaAccessor 
	 * 
	 * @param Schema $schema 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createSchemaAccessor(Schema $schema, array $options = array())
	{
		foreach($this as $factory) {
			if($factory->isSUpportedSchema($schema)) {
				return $factory->createSchemaAccessor($schema, $options);
			}
		}

		throw new \RuntimeException('Not Supported');
	}

	/**
	 * isSupportedSchema 
	 * 
	 * @param Schema $schema 
	 * @access public
	 * @return void
	 */
	public function isSupportedSchema(Schema $schema)
	{
		foreach($this as $factory) {
			if($factory->isSUpportedSchema($schema)) {
				return true;
			}
		}
		return false;
	}
}
