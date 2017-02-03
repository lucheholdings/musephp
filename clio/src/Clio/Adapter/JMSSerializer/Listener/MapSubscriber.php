<?php
namespace Clio\Adapter\JMSSerializer\Listener;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use JMS\Serializer\EventDispatcher\ObjectEvent;

use Clio\Component\Util\Container\Map;

class MapSubscriber implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			array('event' => 'serializer.pre_deserialize', 'method' => 'onPreDeserialize'),
		);
	}

	private $defineTypes = array(
		'AttributeContainer',
		'AttributeCollection',
		'DoctrineAttributeCollection',
		'DoctrineAttributeContainer',
		'Map',

	);

}

