<?php
namespace Clio\Component\Tool\Normalizer\Type;

/**
 * NamedType 
 * 
 * @uses AbstractType
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class NamedType extends AbstractType 
{
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct($name, array $options = array())
	{
		$this->name = $name;

		parent::__construct($options);
	}

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return $this->name;
	}
}

