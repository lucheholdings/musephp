<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Util\Type\Type,
	Clio\Component\Util\Type as Types
;

/**
 * ArrayAccessStrategy
 * 
 * @uses AbstractNormalizer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArrayAccessStrategy extends ArrayStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	protected function doNormalize($data, Type $type, Context $context)
	{
		// 
		$arrayData = array();

		if(!is_array($data) && !($data instanceof \Traversable)) {
			throw new \Exception('ArrayAccessStrategy requires data is an array or Traversable.');
		}

		// Convert to array
		foreach($data as $key => $value) {
			$arrayData[$key] = $value;
		}

		// if "set" then replace keys 
		if($type->isType('set')) {
			$arrayData = array_values($arrayData);
		}

		return $arrayData;
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
		if(!is_array($data) && !$type->isValidData($data)) {
			throw new \InvalidArgumentException('ArrayAccess requires data is an array or valid object.');
		}

		if(is_array($data)) {
			if($type->isType('ArraAccess')) {
				// convert Array::$data to object 
				if(!$object) {
					$object = $type->construct();
				}
				// set key value
				foreach($data as $key => $value) {
					$object[$key] = $value;
				}
				return $object;
			} else if($type->isType('set')){
				return array_values($data);
			} else if($type->isType('array')) {
				return $data;
			}
		}

	}

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return ($type->isType('array') || $type->isType('map') || $type->isType('set') || $type->isType('Traversable'));
	}

	public function canDenormalize($data, $type, Context $context)
	{
		return ($type->isType('array') || $type->isType('map') || $type->isType('set') || $type->isType('ArrayAccess'));
	}
}
