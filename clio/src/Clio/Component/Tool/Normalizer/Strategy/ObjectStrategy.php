<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Util\Type\Type,
	Clio\Component\Util\Type as Types
;

use Clio\Component\Tool\Normalizer\Type\Types as NormalizerTypes,
	Clio\Component\Tool\Normalizer\Type\ReferenceType
;

use Clio\Component\Tool\Normalizer\CircularException;

/**
 * ObjectStrategy
 * 
 * @uses AbstractNormalizer
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ObjectStrategy extends AbstractSchemaStrategy 
{
	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return $type->isType(Types\PrimitiveTypes::TYPE_OBJECT);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return $type->isType(Types\PrimitiveTypes::TYPE_OBJECT);
	}
}
