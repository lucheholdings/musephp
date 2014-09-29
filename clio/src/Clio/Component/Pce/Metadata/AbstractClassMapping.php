<?php
namespace Clio\Component\Pce\Metadata;

/**
 * AbstractClassMapping 
 * 
 * @uses AbstractMapping
 * @uses Mapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AbstractClassMapping extends AbstractMapping implements Mapping
{
	/**
	 * __construct 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata)
	{
		if(!$metadata instanceof ClassMetadata) {
			throw new \Clio\Component\Exception\RuntimeException('Metadata has to be an instanceof ClassMetadata.');
		}

		parent::__construct($metadata);
	}

	/**
	 * getClassMetadata 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClassMetadata()
	{
		return $this->getMetadata();
	}

	/**
	 * setMetadata 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function setMetadata(Metadata $metadata)
	{
		if(!$metadata instanceof ClassMetadata) {
			throw new \Clio\Component\Exception\RuntimeException('Metadata has to be an instanceof ClassMetadata.');
		}

		return parent::setMetadata($metadata);
	}

	public function getReflectionClass()
	{
		return $this->getReflector();
	}
}

