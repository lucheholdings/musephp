<?php
namespace Clio\Component\Util\Type\Actual;

use Clio\Component\Util\Type\PrimitiveTypes;

/**
 * NullType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NullType extends AbstractType 
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct(PrimitiveTypes::TYPE_NULL);
	}

	/**
	 * isType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isType($type)
	{
		return 'null' == $type;
	}

	/**
	 * isValidData 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function isValidData($value)
	{
		return true;
	}

    /**
     * newData 
     * 
     * @access public
     * @return void
     */
    public function newData()
    {
        return null;
    }
}

