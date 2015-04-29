<?php
namespace Clio\Component\Type\Actual;

use Clio\Component\Type\AbstractType;
use Clio\Component\Type\PrimitiveTypes;

/**
 * ArrayType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ArrayType extends AbstractType 
{
    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
	public function __construct()
	{
		parent::__construct(PrimitiveTypes::TYPE_ARRAY);
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
		switch($type) {
		case PrimitiveTypes::TYPE_ARRAY:
			return true;
		default:
			break;
		}

		return false;
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
		return is_array($value);
	}

    public function newData()
    {
        return array();
    }

    public function parseInternalTypes(array $types)
    {
        $count = count($types);
        $parsed = array();
        if(2 <= $count) {
            $parsed = array(
                'key' => $types[0],
                'value' => $types[1],
            );
        } else if(1 == $count) {
            $parsed = array(
                'value' => $types[0],
            );
        }

        return $parsed;
    }
}
