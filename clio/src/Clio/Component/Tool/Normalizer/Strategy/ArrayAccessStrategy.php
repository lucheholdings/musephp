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
class ArrayAccessStrategy extends InterfaceStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	protected function doNormalize($data, Type $type, Context $context)
	{
		// 
		$arrayData = array();

		if($data instanceof \Traversable) {
			foreach($data as $key => $value) {
				$arrayData[$key] = $value;
			}
		} else if(is_array($data)) {
			$arrayData = $data;
		} else {
			throw new \Exception('ArrayAccess also required Traversable to normalize data.');
		}

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
		$denormalized = array();
		// first denormalize internal values.
		if(is_array($data)) {
			foreach($data as $key => $value) {
				$internalType = $context->getFieldType($type, $key);
				if($internalType->isType('mixed')) {
					// get internal type
					if(($type instanceof Types\FieldType) && ($type->options->has('internal_types'))) {
						$types = $type->options->get('internal_types', array());

						$internalType = $types[0];
					}
				}
				$denormalized[$key] = $context->getNormalizer()->denormalize($value, $internalType, $context); 
			}
		}
		
		if($type->isType('map')) {
			return $denormalized;
		} else if($type->isType('set')) {
			return array_values($denormalized);
		}

		// Construct Object
		if($type->isType(Types\PrimitiveTypes::TYPE_OBJECT) && !$object) {
			$object = $type->construct();
		}

		foreach($denormalized as $key => $value) {
			$object[$key] = $value;
		}

		return $object;
	}

	public function getInterfaceName()
	{
		return 'ArrayAccess';
	}

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return $type->isType('array') || $type->isType('set') || $type->isType('set') || (parent::canNormalize($data, $type, $context) && ($type->isType('Traversable')));
	}

	public function canDenormalize($data, $type, Context $context)
	{
		return $type->isType('array') || $type->isType('map') || $type->isType('set') || parent::canDenormalize($data, $type, $context);
	}
}
