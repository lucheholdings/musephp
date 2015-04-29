<?php
namespace Clio\Component\Normalizer\Strategy;

use Clio\Component\Normalizer\Context;
use Clio\Component\Type as Types;

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
	public function canNormalize($data, $type)
	{
		return ($type->isType(Types\PrimitiveTypes::TYPE_CLASS) && $type->isType($this->getClassName()));
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type)
	{
		return ($type->isType(Types\PrimitiveTypes::TYPE_CLASS) && $type->isType($this->getClassName()));
	}

}

