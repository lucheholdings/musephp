<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\Schema\AccessorFactory as SchemaAccessorFactory;
use Clio\Component\Pattern\Factory\NamedCollection;
use Clio\Component\Util\Accessor\ChainProxySchemaAccessor;
use Clio\Component\Util\Validator\ClassValidator;

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
class Collection extends NamedCollection 
{
	protected function initFactory()
	{
		$this->getStorage()->setValueValidator(new ClassValidator('Clio\Component\Util\Accessor\Schema\AccessorFactory'));
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($type, array $args = array())
	{
		return $this->getFactory($type)->isSupportedSchema(array_shift($args), $args);
	}
}
