<?php
namespace Clio\Bridge\SymfonyComponents\Notify\Event\Listener;

use Clio\Bridge\SymfonyComponents\Debug\Event\IntervalEvent;
use Clio\Extra\Debug\Notifies;

use Symfony\Component\Stopwatch\StopwatchInterface;

/**
 * TimelineNotifiedSubscriber 
 * 
 * @uses NotifiedEventSubscribere
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TimelineNotifiedSubscriber extends NotifiedEventSubscriber 
{
	/**
	 * getSubscribedNotifies 
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function getSubscribedNotifies()
	{
		return array(
			Notifies::IntervalBegin   => 'onIntervalBegin',
			Notifies::IntervalEnd     => 'onIntervalEnd',
		);
	}
	
	/**
	 * stopwatch 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $stopwatch;

	/**
	 * __construct 
	 * 
	 * @param StopwatchInterface $stopwatch 
	 * @access public
	 * @return void
	 */
	public function __construct(StopwatchInterface $stopwatch)
	{
		$this->stopwatch = $stopwatch;
	}

	/**
	 * onIntervalBegin 
	 * 
	 * @param IntervalEvent $event 
	 * @access public
	 * @return void
	 */
	public function onIntervalBegin(IntervalEvent $event)
	{
		$this->getStopwatch()->start($event->getOption('name'));
	}

	/**
	 * onIntervalEnd 
	 * 
	 * @param IntervalEvent $event 
	 * @access public
	 * @return void
	 */
	public function onIntervalEnd(IntervalEvent $event)
	{
		$this->getStopwatch()->stop($event->getOption('name'));
	}
    
    /**
     * getStopwatch 
     * 
     * @access public
     * @return void
     */
    public function getStopwatch()
    {
        return $this->stopwatch;
    }
    
    /**
     * setStopwatch 
     * 
     * @param StopwatchInterface $stopwatch 
     * @access public
     * @return void
     */
    public function setStopwatch(StopwatchInterface $stopwatch)
    {
        $this->stopwatch = $stopwatch;
        return $this;
    }
}
