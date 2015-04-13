<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Util\Type as Types;

/**
 * ArrayStrategy
 * 
 * @uses AbstractNormalizer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArrayStrategy extends AbstractSchemaStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	protected function doNormalize($data, Type $type, Context $context)
	{
		// 
		if(!is_array($data)) {
			throw new UnsupportedException('Data "%s" is not an array.', is_object($data) ? get_class($data) : gettype($data));
		}

		if($type->isType('set')) {
			return array_values($data);
		} else {
			return $data;
		}
	}

	/**
	 * doDenormalize 
	 *   
	 * @param mixed $data 
	 * @param Type $type 
	 * @param Context $context 
	 * @param mixed $object 
	 * @access protected
	 * @return void
	 */
	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		// 
		if(!is_array($data)) {
			throw new UnsupportedException('Data "%s" is not an array.', is_object($data) ? get_class($data) : gettype($data));
		}

		if($type->isType('set')) {
			return array_values($data);
		} else {
			return $data;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type)
	{
		return ($type->isType('array') || $type->isType('map') || $type->isType('set')) && is_array($data);
	}

	public function canDenormalize($data, $type)
	{
		return ($type->isType('array') || $type->isType('map') || $type->isType('set')) && is_array($data);
	}
}
