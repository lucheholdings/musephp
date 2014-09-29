<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Counter\Factory;

use Clio\Component\Pce\Construction\ComponentFactory;
/**
 * MemcachedCounterMapFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MemcachedCounterMapFactory extends ComponentFactory
{
	private $container;

	public function __construct($container)
	{
		parent::__construct('Clio\Component\Tool\Counter\MemcachedCounterMap');
		
		$this->container = $container;
	}

	public function resolveArguments(array $args = array())
	{
		if(isset($args[0])) {
			$args[0] = $this->container->get($args[0]);
		}
		return $args;
	}
}

