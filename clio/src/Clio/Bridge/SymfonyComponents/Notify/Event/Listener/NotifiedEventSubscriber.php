<?php
namespace Clio\Bridge\SymfonyComponents\Notify\Event\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * NotifiedEventSubscriber 
 * 
 * @uses EventSubscriberInterface
 * @uses ContainerAwareInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class NotifiedEventSubscriber implements EventSubscriberInterface, ContainerAwareInterface
{
	/**
	 * getSubscribedEvents 
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function getSubscribedEvents()
	{
		return static::getSubscribedNotifies();
	}
	
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
	public function __construct(ContainerInterface $container = null)
	{
		$this->container = $container;
	}
    
    /**
     * getContainer 
     * 
     * @access public
     * @return void
     */
    public function getContainer()
    {
		if(!$this->container) 
			throw new \RuntimeException('$container is not initialized yet.');
        return $this->container;
    }
    
    /**
     * setContainer 
     * 
     * @param ContainerInterface $container 
     * @access public
     * @return void
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }
}
