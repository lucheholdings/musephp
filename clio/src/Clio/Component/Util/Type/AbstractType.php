<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Exception\NotImplementedException;

/**
 * AbstractType 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractType implements Type, Convertable 
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
	public function __construct($name)
	{
		$this->name = $name;
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

	public function __toString()
	{
		return $this->name;
	}

	/**
	 * convertData 
	 * 
	 * @param mixed $data 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	public function convertData($data, Type $type)
	{
		if($this->getName() == $type->getName()) {
			// no conversion
			return $data;
		} else if($type->isType(PrimitiveTypes::TYPE_NULL)) {
			return null;
		} 

		throw new UnsupportedException(sprintf('Convert data from "%s" to "%s" is not supported', (string)$this, (string)$type));
	}
}

