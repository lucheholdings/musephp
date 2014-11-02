<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\Schema\Factory as SchemaAccessorFactory;
use Clio\Component\Pattern\Factory\NamedCollection;
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
class SchemaAccessorFactoryCollection extends NamedCollection 
{
	protected function initFactory()
	{
		$this->getStorage()->setValueValidator(new ClassValidator('Clio\Component\Util\Accessor\Schema\Factory'));
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($type, array $args = array())
	{
		return $this->getFactory($type)->isSupportedSchema(array_shift($args), $args);
	}
}
