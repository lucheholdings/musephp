<?php
namespace Clio\Bridge\SymfonyComponents\Notify\Event\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Clio\Bridge\SymfonyComponents\Notify\Event\NotifiedEvent;
use Clio\Extra\Serializer\Notifies;

use Clio\Extra\Log\Notifies as LogNotifies;
use Clio\Extra\Debug\Notifies as DebugNotifies;

/**
 * SerializerNotifiedSubscriber 
 * 
 * @uses EventSubscriberInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SerializerNotifiedSubscriber extends NotifiedEventSubscriber
{
	static public function getSubscribedNotifies()
	{
		return array(
				Notifies::SerializationBegin => 'onSerializationBegin',
				Notifies::SerializationEnd   => 'onSerializationEnd',
				Notifies::DeserializationBegin => 'onDeserializationBegin',
				Notifies::DeserializationEnd   => 'onDeserializationEnd',
			);
	}

	/**
	 * onSerializationBegin 
	 *
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function onSerializationBegin(NotifiedEvent $event)
	{
		$event->getNotifier()->notify(LogNotifies::Info, array('message' => 'Serialization Begin'));
		$event->getNotifier()->notify(DebugNotifies::IntervalBegin, array('name' => 'serialization'));
	}

	/**
	 * onSerializationEnd 
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function onSerializationEnd(NotifiedEvent $event)
	{
		$event->getNotifier()->notify(LogNotifies::Info, array('message' => 'Serialization End'));
		$event->getNotifier()->notify(DebugNotifies::IntervalEnd, array('name' => 'serialization'));
	}

	/**
	 * onDeserializationBegin 
	 *
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function onDeserializationBegin(NotifiedEvent $event)
	{
		$event->getNotifier()->notify(LogNotifies::Info, array('message' => 'Deserialization Begin'));
		$event->getNotifier()->notify(DebugNotifies::IntervalBegin, array('name' => 'deserialization'));
	}

	/**
	 * onDeserializationEnd 
	 * 
	 * @param NotifiedEvent $event 
	 * @access public
	 * @return void
	 */
	public function onDeserializationEnd(NotifiedEvent $event)
	{
		$event->getNotifier()->notify(LogNotifies::Info, array('message' => 'Deserialization End'));
		$event->getNotifier()->notify(DebugNotifies::IntervalEnd, array('name' => 'deserialization'));
	}
}

