<?php
namespace Clio\Adapter\Doctrine\Event\Subscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;

class AttributeContainerAwareEventSubscriber implements EventSubscriber 
{
	/**
	 * loadClassMetadata 
	 * 
	 * @param LoadClassMetadataEventArgs $eventArgs 
	 * @access public
	 * @return void
	 */
	public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
	{
		$registry = $this->getClassMetadataRegistry();

		$className = $eventArgs->getClassMetadata()->getName();

		if($registry->hasClassMetadata($className)) {
			$classMetadata = $registry->getClassMetadata($class);

			if(!$classMetadata->hasMapping('attribute')) {

				$classMetadata->getMapping('attribute')->setAttributeClass($this->getAttributeClass());
			}
		}
	}
}
