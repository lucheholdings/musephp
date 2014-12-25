<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\ObjectType;
use Clio\Component\Tool\Normalizer\Type;
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
abstract class ObjectStrategy extends AbstractStrategy 
{
	public function normalize($data, $type = null, Context $context = null)
	{
		if(!$context) {
			throw new \InvalidArgumentException('Strategy requires Context is not null.');
		}
		
		if(!$type) {
			throw new \InvalidArgumentException('Strategy requires Type is not null.');
		} else if(!$type instanceof Type) {
			throw new \InvalidArgumentException(sprintf('Strategy requires $type is an instanceof of Type, but "%s" is given.', is_object($type) ? get_class($type) : gettype($type)));
		}
	
		// normalize the data to array
		$normalized = $this->doNormalize($data, $type, $context);
		
		if(is_array($normalized)) {
			// recursively call normalize
			array_walk($normalized, function(&$value, $key, $data) {
				if(null === $value) {
					return;
				}
				list($context, $type) = $data;

				$fieldType = $type->getFieldType($key, $context);

				try {
					$this->enterScope($context, $value, $fieldType, $key);

					$value = $context->getNormalizer()->normalize($value, $fieldType, $context);

					$this->leaveScope($context);
				} catch(CircularException $ex) {
					// if data type can refer then avoid circularException.
					if(!$fieldType->canReference()) {
						throw $ex;
					}
					$value = $context->getNormalizer()->normalize($value, $fieldType->reference(), $context);
				}
			}, array($context, $type));
		}

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
			throw new \InvalidArgumentException(sprintf('Strategy requires $type is an instanceof of Type, but "%s" is given.', is_object($type) ? get_class($type) : gettype($type)));
		}

		// Convert data before denormalize
		if(is_array($data)) {
			array_walk($data, function(&$value, $key, $data) {
				list($type, $context) = $data;
				// Field Type
				if($fieldType = $type->getFieldType($key, $context)) {
					$fieldType = $context->getTypeRegistry()->getType($fieldType);
				} else {
					$fieldType = $context->getTypeRegistry()->guessType($value);
				}
				
				$context->enterScope($value, $fieldType, $key);
				// 
				$value = $context->getNormalizer()->denormalize($value, $fieldType, $context);

				$context->leaveScope();

			}, array($type, $context));
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

		if(($type instanceof ObjectType) && $type->canReference()) { 
			$type->getDataPool()->add($denormalized);
		}

		$context->leaveScope();

		return $denormalized;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType);
	}
}
