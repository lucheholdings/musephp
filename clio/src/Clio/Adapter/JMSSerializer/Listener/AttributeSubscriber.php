<?php
namespace ;

/**
 * Class 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeSubscriber 
{
	
	public function onPreSerialize()
	{
		$type = $event->getType();

		if(class_exists($type['name'])) {
			$typeClass = new \ReflectionClass($type['name']);

			if($typeClass->implementsInterface('Clio\Component\Util\Attribute\Attribute')) {
				
			}
		} 
	}

	public function onPreDeserialize()
	{
		// 
		$event->setData($data);
	}
}

