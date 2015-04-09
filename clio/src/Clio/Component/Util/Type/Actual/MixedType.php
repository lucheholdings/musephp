<?php
namespace Clio\Component\Util\Type\Actual;

use Clio\Component\Util\Type\PrimitiveTypes;

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
	public function __construct()
	{
		parent::__construct(PrimitiveTypes::TYPE_MIXED);
	}

	public function isType($type)
	{
		return 'mixed' == $type;
	}

	public function isValidData($value)
	{
		return true;
	}

	public function resolve(Resolver $resolver, $data = null)
	{
		return $resolver->resolve($this, array('data' => $data));
	}

	public function isResolved()
	{
		return false;
	}
}

