<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Container\Map\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Component\DependencyInjection\ContainerAwareInterface
;

/**
 * ServiceStorageMapFactory 
 * 
 * @uses AbstractMapFactory
 * @uses ContainerAwareInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ServiceStorageMapFactory extends AbstractMapFactory implements ContainerAwareInterface
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access private
	 */
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
     * {@inheritdoc}
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }
}

