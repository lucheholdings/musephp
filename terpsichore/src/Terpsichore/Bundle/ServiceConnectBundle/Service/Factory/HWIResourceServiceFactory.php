<?php
namespace Terpsichore\Bundle\ServiceConnectBundle\Service\Factory;

use Terpsichore\Core\Factory\ServiceFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * HWIResourceServiceFactory 
 * 
 * @uses ServiceFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HWIResourceServiceFactory extends ServiceFactory 
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		parent::__construct('Terpsichore\Bundle\ServiceConnectBundle\Service\HWIResourceService');

		$this->container = $container;
	}

	public function createByServiceName($hwiResourceName)
	{
		$resourceOwner = $this->getContainer()->get('terpsichore_service_connect.hwi_resource_owner.' . $hwiResourceName);

		return $this->create($resourceOwner);
	}
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }
}

