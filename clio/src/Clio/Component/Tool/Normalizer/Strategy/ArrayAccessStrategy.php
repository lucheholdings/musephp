<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type;

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

		if($type instanceof Type\SetType) {
			$arrayData = array_values($arrayData);
		}

		return $arrayData;
	}

	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		if($type instanceof Type\MapType) {
			return $data;
		} else if($type instanceof Type\SetType) {
			return array_values($data);
		}

		// Construct Object
		if(!$object) {
			$object = $type->construct();
		}

		foreach($data as $key => $value) {
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
		return ($type instanceof Type\MapType) || ($type instanceof Type\SetType) || (parent::canNormalize($data, $type, $context) && ($type->getClassReflector()->isSubclassof('Traversable')));
	}

	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof Type\MapType) || ($type instanceof Type\SetType) || parent::canDenormalize($data, $type, $context);
	}
}
