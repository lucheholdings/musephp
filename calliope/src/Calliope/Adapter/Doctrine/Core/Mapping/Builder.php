<?php
namespace Calliope\Adapter\Doctrine\Core\Mapping;

use Clio\Component\Pce\Construction\ComponentFactory;
/**
 * Builder 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 */
class Builder 
{
	/**
	 * class 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $class;

	/**
	 * __construct 
	 * 
	 * @param mixed $options 
	 * @access public
	 * @return void
	 */
	public function __construct($options)
	{
		if(!empty($options)) {
			if(isset($options['class'])) {
				$this->setClass($options['class']);
			}
		}
	}

	/**
	 * setClass 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function setClass($class)
	{
		$this->class = $class;
	}

	/**
	 * getClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClass()
	{
		return $this->class;
	}

	/**
	 * getComponentFactory
	 *   Get Factory to create this mapping class instance
	 * @access public
	 * @return void
	 */
	public function getComponentFactory()
	{
		return new ComponentFactory($this->getClass());
	}
}

