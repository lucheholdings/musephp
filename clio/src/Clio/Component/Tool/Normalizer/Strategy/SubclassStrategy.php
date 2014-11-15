<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\ObjectType;

/**
 * SubclassStrategy 
 *   SubclassStrategy is a type of ObjectStrategy
 *   This type of strategy CAN BE for an instance of the class or subclass of the class
 * 
 * @uses ObjectStrategy
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class SubclassStrategy extends ObjectStrategy
{
	abstract protected function getClassName();

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType) && ($type->getClassReflector()->isSubclassOf($this->getClassName()));
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType) && ($type->getClassReflector()->isSubclassOf($this->getClassName()));
	}

}

