<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Registry;

use Clio\Component\Pattern\Registry\ReferenceRegistry as BaseRegistry;
use Clio\Adapter\SymfonyBundles\ComponentBundle\DepedencyInjection\Reference;

/**
 * ReferenceRegistry 
 * 
 * @uses BaseRegistry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ReferenceRegistry extends BaseRegistry implements Reference 
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_container;

	/**
	 * registryId 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_registryId;

	/**
	 * {@inheritdoc}
	 */
	public function getRegistry()
	{
		$registry = parent::getRegistry();
		if(!$registry) {
			if(!$this->container) {
				throw new \RuntimeException('Container is not initialized.');
			}
			$registry = $this->container->get($this->serviceId);

			if(!$registry) {
				throw new \RuntimeException(sprintf('Registry "%s" is not registered on the ServiceContainer', $this->serviceId));
			}

			parent::setRegistry($registry);
		}

		return $registry;
	}
	
	public function _setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	public function _setServiceId($serviceId)
	{
		$this->serviceId = $serviceId;
	}
}

