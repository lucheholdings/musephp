<?php
namespace Clio\Bridge\SymfonyComponents\Notify;

use Clio\Component\Util\Notify\Notifier;
use Symfony\Component\EventDispatcher\EventDispatcherInterface,
	Symfony\Component\EventDispatcher\EventDispatcher
;
/**
 * EventDispatchNotifier 
 * 
 * @uses Notifier
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class EventDispatchNotifier implements Notifier 
{
	/**
	 * eventDispatcher 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $eventDispatcher;

	/**
	 * __construct 
	 * 
	 * @param EventDispatcherInterface $eventDispatcher 
	 * @access public
	 * @return void
	 */
	public function __construct(EventDispatcherInterface $eventDispatcher = null)
	{
		$this->eventDispatcher = $eventDispatcher;
	}

	/**
	 * notify 
	 * 
	 * @param mixed $notify 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function notify($notify, array $args = array())
	{
		$event = new Event\NotifiedEvent($this, $args);
		$this->getEventDispatcher()->dispatch($notify, $event);

		return $event->getResponse();
	}
    
    /**
     * getEventDispatcher 
     * 
     * @access public
     * @return void
     */
    public function getEventDispatcher()
    {
		if(!$this->eventDispatcher) {
			$this->eventDispatcher = new EventDispatcher();
		}
        return $this->eventDispatcher;
    }
    
    /**
     * setEventDispatcher 
     * 
     * @param EventDispatcherInterface $eventDispatcher 
     * @access public
     * @return void
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        return $this;
    }
}

