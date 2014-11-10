<?php
namespace Clio\Adapter\JMSSerializer\Listener;

use Clio\Component\Util\Metadata\SchemaMetadataRegistry;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;
use JMS\Serializer\EventDispatcher\ObjectEvent;
/**
 * AttributeMapSubscriber 
 * 
 * @uses EventSubscriberInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeMapAwareSubscriber implements EventSubscriberInterface 
{
	static public function getSubscribedEvents()
	{
		return array(
			array('event' => 'serializer.pre_deserialize', 'method' => 'onPreDeserialize'),
		);
	}

	private $registry;

	public function __construct(SchemaMetadataRegistry $registry)
	{
		$this->registry = $registry;
	}

	public function onPreDeserialize(PreDeserializeEvent $event)
	{
		$type = $event->getType();

		if(class_exists($type['name'])) {
			$typeClass = new \ReflectionClass($type['name']);

			if($typeClass->implementsInterface('Clio\Component\Util\Attribute\AttributeMapAware')) {
				// Move unknow fields into attributes
				$context = $event->getContext();
				$data = $event->getData();
				$naming = $context->getVisitor()->getNamingStrategy();

// Check with the JMSSerialize Metadata
				$metadataFactory = $context->getMetadataFactory();
				$metadata = $metadataFactory->getMetadataForClass($type['name']);

				$propertyMetadatas = $metadata->propertyMetadata;

				$attributes = isset($data['attributes']) ? $data['attributes'] : array();
				$propNames = array();
				$attributes = array();
				foreach($propertyMetadatas as $prop) {
					$propNames[] = $naming->translateName($prop);
				}

				foreach($data as $key => $value) {
					if(!in_array($key, $propNames)) {
						$attributes[$key] = $value;
						unset($data[$key]);
					}
				}
				$data['attributes'] = $attributes;

				$event->setData($data);
			}
		} 
	}

	public function getClassMetadataRegistry()
	{
		return $this->registry;
	}
}

