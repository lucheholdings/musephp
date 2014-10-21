<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy;
use Clio\Component\Tool\Normalizer\Type,
	Clio\Component\Tool\Normalizer\Type\ObjectType
;
use Clio\Component\Tool\Normalizer\Context;

abstract class AbstractStrategy implements Strategy
{
	public function normalize($data, $type = null, Context $context = null)
	{
		if(!$context) {
			throw new \InvalidArgumentException('Strategy requires Context is not null.');
		}
		
		if(!$type) {
			throw new \InvalidArgumentException('Strategy requires Type is not null.');
		} else if(!$type instanceof Type) {
			throw new \InvalidArgumentException('Strategy requires $type is an instanceof of Type.');
		}

		try {
			$context->enterScope($data, $type);
		} catch(CircularException $ex) {
			// if data type can refer then avoid circularException.
			$type = $context->getTypeRegistry()->guessType($data);
			if(!($type instanceof ObjectType) || !$type->canReference()) {
				throw $ex;
			}
			$context->enterScope($data, $type->reference());
		}
		
		// normalize the data to array
		$normalized = $this->doNormalize($data, $type, $context);
		
		if(is_array($normalized)) {
			array_walk($normalized, function(&$value, $key, $context) {
				$value = $context->getNormalizer()->normalize($value, $context);
			}, $context);
		}

		$context->leaveScope();

		return $normalized;
	}

	/**
	 * {@inheritdoc}
	 */
	public function denormalize($data, $type, Context $context = null)
	{
		if(!$context) {
			throw new \InvalidArgumentException('Strategy requires Context is not null.');
		}

		if(!$type instanceof Type) {
			throw new \InvalidArgumentException('Strategy required $type as an instanceof of Type.');
		}

		// Check the data is already in scope or not
		// Enter Scope
		$scope = $context->enterScope($data, $type);

		// Convert data before denormalize
		if(is_array($data)) {
			array_walk($data, function(&$value, $key, $type, $context) {
				// Field Type
				if($fieldType = $type->getFieldType($key)) {
					$fieldType = $context->getTypeRegistry()->getType($fieldType);
				} else {
					$fieldType = $context->getTypeRegistry()->guessType($value);
				}
				// 
				$value = $context->getDenormalizer()->denormalize($value, $fieldType, $context);
			}, $type, $context);
		}
		
		// after all denormalize child fields, denormalize the data. 
		// But first check the pool if the data exists
		$object = null;
		if($type instanceof ObjectType) {
			$identifiers = array();
			foreach($type->getIdentifierFields() as $field) {
				if(!isset($data[$field])) {
					$identifiers = null;
					break;
				}

				$identifiers[$field] = $data[$field];
			}

			if($identifiers) {
				// use this as object
				$object = $type->getDataPool()->getByIdentifiers($identifiers);
			}
		}

		$denormalized = $this->doDenormalize($data, $type, $context, $object);

		if($type instanceof ObjectType) { 
			$type->getDataPool()->add($denormalized);
		}

		$context->leaveScope();

		return $denormalized;
	}

	/**
	 * doNormalize 
	 * 
	 * @param mixed $data 
	 * @param mixed $context 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doNormalize($data, Type $type, Context $context);

	/**
	 * doNormalize 
	 * 
	 * @param mixed $data 
	 * @param mixed $type 
	 * @param mixed $context 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doDenormalize($data, Type $type, Context $context, $object = null);
}

