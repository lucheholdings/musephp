<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Counter;

use Clio\Component\Tool\Counter\Counter;
use Clio\Component\Pattern\Registry\AbstractRegistry;
//use Clio\Bridge\Symfony\DependencyInjection\Pattern\Registry\ServiceReferenceRegistry;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * CounterRegistry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
//class CounterRegistry extends ServiceReferenceRegistry
class CounterRegistry extends AliasedServiceRegistry 
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
	/**
	 * {@inheritdoc}
	 */
	protected function isValidService($service)
	{
		return ($service instanceof Counter) || is_string($service);
	}

	public function get($id)
	{
		$service = parent::get($id);

		if(is_string($service)) {
			$service = $this->container->get($service);
			$this->set($id, $service);
		}

		return $service;
	}
}

