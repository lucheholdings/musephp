<?php
namespace Clio\Component\Util\Metadata\Field;

/**
 * PropertyMetadata 
 * 
 * @uses AbstractFieldMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyMetadata extends AbstractFieldMetadata 
{
	/**
	 * {@inheritdoc}
	 */
	private $reflectionProperty;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(\ReflectionProperty $reflectionProperty)
	{
		$this->reflectionProperty = $reflectionProperty;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->getReflectionProperty()->getName();
	}
    
    /**
     * getReflectionProperty 
     * 
     * @access public
     * @return void
     */
    public function getReflectionProperty()
    {
        return $this->reflectionProperty;
    }
}

