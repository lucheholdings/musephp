<?php
namespace Clio\Adapter\Doctrine\EventListener;

/**
 * HashIdentifiableListener 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HashIdentifiableListener
{
	/**
	 * __construct 
	 * 
	 * @param HashResolverInterface $resolver 
	 * @access public
	 * @return void
	 */
	public function __construct(HashResolverInterface $resolver)
	{
		$this->resolver = $resolver;
	}

	/**
	 * prePersist 
	 * 
	 * @param mixed $event 
	 * @access public
	 * @return void
	 */
	public function prePersist($event)
	{
		$entity = $event->getEntity();
		if($this->isTargetClass($entity)) {
			$entity = $this->getHashResolver()->resolveHash($entity);
		}
	}

	/**
	 * isTargetClass 
	 * 
	 * @param mixed $entity 
	 * @access public
	 * @return void
	 */
	public function isTargetClass($entity)
	{
		return ($entity instanceof HashIdentifiable);
	}
}

