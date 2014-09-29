<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Container\Map\Factory;

use Clio\Component\Pattern\Factory\ComponentFactory;

/**
 * AbstractMapFactory 
 * 
 * @uses ComponentFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMapFactory extends ComponentFactory
{
	/**
	 * storageFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $storageFactory;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct('Clio\Component\Util\Container\Map\StoragedMap');

		$this->storageFactory = new ComponentFactory($this->getStorageClass());
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreate(array $args)
	{
		$args = $this->resolveArguments($args);

		$storage = $this->doCreateStorage($args);

		return $this->getReflectionClass()->newInstanceArgs(array($storage));
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreateStorage($args)
	{
		return $this->storageFactory->createArgs($args);
	}

	/**
	 * {@inheritdoc}
	 */
	abstract protected function getStorageClass();
}

