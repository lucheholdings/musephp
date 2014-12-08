<?php
namespace Clio\Bridge\SymfonyComponents\Registry;

use Clio\Component\Pattern\Registry\RegistryMap;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * AliasContainerRegistry 
 * 
 * @uses RegistryMap
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class AliasContainerRegistry extends RegistryMap 
{
	private $container;

	/**
	 * __construct 
	 * 
	 * @param ContainerInterface $container 
	 * @access public
	 * @return void
	 */
	public function __construct(ContainerInterface $container)
	{
		parent::__construct();
		$this->container = $container;
	}

	/**
	 * get 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function get($id)
	{
		$service = parent::get($id);

		return $this->getContainer()->get($service);
	}

	/**
	 * getAlias 
	 * 
	 * @param mixed $id 
	 * @access public
	 * @return void
	 */
	public function getAlias($id)
	{
		return parent::get($id);
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

