<?php
namespace Clio\Adapter\JMSSerializer\Listener;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use JMS\Serializer\EventDispatcher\ObjectEvent;


class DoctrineReferenceSubscriber implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			array('event' => 'serializer.pre_serialize', 'method' => 'onPreSerialize'),
		);
	}

	public function onPreSerialize(PreSerializeEvent $event)
	{
		$type = $event->getType();

		if($type['name'] === 'DoctrineReference') {
			$event->setType($type['params'][0]['name'], array());
		} 
	}
}

