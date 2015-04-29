<?php
namespace Clio\Component\Type;

use Clio\Component\Type\PrimitiveTypes;

/**
 * MixedType 
 *   Mixed type is a special type which is not concrete and ambiguos 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MixedType extends AbstractType 
{
    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
	public function __construct()
	{
		parent::__construct(PrimitiveTypes::TYPE_MIXED);
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
		return 'mixed' == $type;
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
     * resolve 
     * 
     * @param Resolver $resolver 
     * @param mixed $data 
     * @access public
     * @return void
     */
	public function resolve(Resolver $resolver, $data = null)
	{
		return $resolver->resolve($this, array('data' => $data));
	}

    /**
     * isResolved 
     * 
     * @access public
     * @return void
     */
	public function isResolved()
	{
		return false;
	}
}

