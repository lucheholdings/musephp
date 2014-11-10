<?php
namespace Erato\Core\Tests;

use Clio\Component\Tool\Normalizer\NormalizationStrategy,
	Clio\Component\Tool\Normalizer\DenormalizationStrategy
;


class DummyNormalizerStrategy implements
	NormalizationStrategy,
	DenormalizationStrategy
{
	public function __construct(\ReflectionClass $reflectionClass)
	{
		$this->reflectionClass = $reflectionClass;
	}
	
	public function canNormalize($object)
	{
		return true;
	}

	public function normalize($object)
	{
		return array(); 
	}

	public function canDenormalize($data, $class)
	{
		return true; 
	}

	public function denormalize($data, $class)
	{
		return $this->reflectionClass->newInstance();
	}
}

