<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Schema\NamedAccessorFactory;
use Clio\Component\Pattern\Factory\AbstractFactory;

/**
 * AbstractNamedAccessorFactory 
 * 
 * @uses MappedFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractNamedAccessorFactory extends AbstractFactory implements NamedAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	protected function doCreate(array $args)
	{
		return $this->createByKeyArgs($this->shiftArg($args, self::ARG_NAME), $args);
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKey()
	{
		$args = func_get_args();
		return $this->createByKeyArgs($this->shiftArg($args, self::ARG_NAME), $args);
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKeyArgs($key, array $args = array())
	{
		$options = $this->shiftArg($args, self::ARG_OPTIONS, array());

		return $this->createSchemaAccessorByName($key, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedArgs(array $args = array())
	{
		return $this->isSupportedKeyArgs(array_shift($args), $args);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($key, array $args = array())
	{
		// if name can solve to schema, then true
		return (bool)$this->guessSchemaFromName($key);
	}
}

