<?php
namespace Calliope\Extension\Media\Core\Factory;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Container\Validator\ClassValidator;

use Calliope\Extension\Media\Core\Factory\MediaFactory;

/**
 * TypeMediaFactory 
 * 
 * @uses Map
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TypeMediaFactory extends Map 
{
	public function __construct()
	{
		parent::__construct();

		$this->setValueValidator(new ClassValidator('Calliope\Extension\Media\Core\Factory\MediaFactory'));
	}
	
	/**
	 * createTypeMedia 
	 * 
	 * @param mixed $type 
	 * @param mixed $name 
	 * @param mixed $options 
	 * @access public
	 * @return void
	 */
	public function createTypeMedia($type, $name, $options)
	{
		return $this->get($type)->createMedia($name, $options);
	}

	/**
	 * setMediaFactory 
	 * 
	 * @param mixed $type 
	 * @param Media $media 
	 * @access public
	 * @return void
	 */
	public function setMediaFactory($type, MediaFactory $media)
	{
		$this->set($type, $media);

		return $this;
	}

	public function getMediaFactory($type)
	{
		return $this->get($type);
	}

	/**
	 * hasMedia 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function hasMediaFactory($type)
	{
		return $this->hasKey($type);
	}
}

