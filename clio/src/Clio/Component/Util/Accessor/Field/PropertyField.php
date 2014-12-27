<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * PropertyField 
 * 
 * @uses AbstractField
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PropertyField extends AbstractField 
{
	/**
	 * propertyReflector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $propertyReflector;

	/**
	 * __construct 
	 * 
	 * @param \ReflectionProperty $propertyReflector 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionProperty $propertyReflector, $alias = null)
	{
		$this->propertyReflector = $propertyReflector;
		parent::__construct($alias);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->getPropertyReflector()->getName();
	}

    /**
     * getPropertyReflector 
     * 
     * @access public
     * @return void
     */
    public function getPropertyReflector()
    {
        return $this->propertyReflector;
    }
    
    /**
     * setPropertyReflector 
     * 
     * @param mixed $propertyReflector 
     * @access public
     * @return void
     */
    public function setPropertyReflector($propertyReflector)
    {
        $this->propertyReflector = $propertyReflector;
        return $this;
    }
}
