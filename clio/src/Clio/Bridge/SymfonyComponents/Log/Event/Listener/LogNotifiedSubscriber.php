<?php
namespace Clio\Bridge\SymfonyComponents\Log\Event\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Clio\Bridge\SymfonyComponents\Notify\Event\NotifiedEvent;
use Clio\Extra\Log\Notifies;

use Psr\Log\LoggerInterface,
	Psr\Log\NullLogger,
	Psr\Log\LogLevel,
;

/**
 * LogNotifiedSubscriber 
 * 
 * @uses EventSubscriberInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class LogNotifiedSubscriber implements EventSubscriberInterface 
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
			Notifies::Emergency   => 'logEmergency', 
			Notifies::Alert       => 'logAlert',
			Notifies::Critical    => 'logCritical',
			Notifies::Error       => 'logError',
			Notifies::Warning     => 'logWarning',
			Notifies::Notice      => 'logNotice',
			Notifies::Info        => 'logInfo',
			Notifies::Debug       => 'logDebug',
			Notifies::Log         => 'log',
		);
	}

	/**
	 * logger 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $logger;
	
	/**
	 * __construct 
	 * 
	 * @param LoggerInterface $logger 
	 * @access public
	 * @return void
	 */
	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * logEmergency
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function logEmergency(NotifiedEvent $event)
	{
		$event->setOption(Notifies::OPTION_LOG_LEVEL, LogLevel::EMERGENCY);
		$this->log($event);
	}

	/**
	 * logAlert
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function logAlert(NotifiedEvent $event)
	{
		$event->setOption(Notifies::OPTION_LOG_LEVEL, LogLevel::ALERT);
		$this->log($event);
	}

	/**
	 * logCritical
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function logCritical(NotifiedEvent $event)
	{
		$event->setOption(Notifies::OPTION_LOG_LEVEL, LogLevel::CRITICAL);
		$this->log($event);
	}

	/**
	 * logError 
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function logError(NotifiedEvent $event)
	{
		$event->setOption(Notifies::OPTION_LOG_LEVEL, LogLevel::ERROR);
		$this->log($event);
	}

	/**
	 * logWarning 
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function logWarning(NotifiedEvent $event)
	{
		$event->setOption(Notifies::OPTION_LOG_LEVEL, LogLevel::WARNING);
		$this->log($event);
	}

	/**
	 * logNotice 
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function logNotice(NotifiedEvent $event)
	{
		$event->setOption(Notifies::OPTION_LOG_LEVEL, LogLevel::NOTICE);
		$this->log($event);
	}

	/**
	 * logInfo 
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function logInfo(NotifiedEvent $event)
	{
		$event->setOption(Notifies::OPTION_LOG_LEVEL, LogLevel::INFO);
		$this->log($event);
	}

	/**
	 * logDebug 
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function logDebug(NotifiedEvent $event)
	{
		$event->setOption(Notifies::OPTION_LOG_LEVEL, LogLevel::DEBUG);
		$this->log($event);
	}

	/**
	 * log 
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function log(NotifiedEvent $event)
	{
		$this->getLogger()->log($event->get(Notifies::OPTION_LOG_LEVEL), $event->getOption(Notifies::OPTION_MESSAGE), $event->getOption(Notifies::OPTION_CONTEXT));
	}

    /**
     * getLogger 
     * 
     * @access public
     * @return void
     */
    public function getLogger()
    {
		if(!$this->logger) 
			$this->logger = new NullLogger();
        return $this->logger;
    }
    
    /**
     * setLogger 
     * 
     * @param LoggerInterface $logger 
     * @access public
     * @return void
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }
}

