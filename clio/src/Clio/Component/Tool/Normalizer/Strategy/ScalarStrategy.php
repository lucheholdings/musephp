<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Type\PrimitiveType;
use Clio\Component\Tool\Normalizer\Context;

class ScalarStrategy extends AbstractStrategy implements NormalizationStrategy, DenormalizationStrategy
{
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof PrimitiveType);
	}

	protected function doNormalize($data, Type $type, Context $context)
	{
		return $data;
	}

	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof PrimitiveType);
	}

	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		return $data;

		// 
		switch($type) {
		case 'string':
			$data = (string)$data;
			break;
		case 'integer':
		case 'int':
			$data = (int)$data;
			break;
		case 'double':
			$data = (double)$data;
			break;
		case 'float':
			$data = (float)$data;
			break;
		case 'bool':
		case 'boolean':
			$data = (bool)$data;
			break;
		case 'mixed':
		default:
			break;
		}
		return $data;
	}
}

