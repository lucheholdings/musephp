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

				$fieldType = $context->getFieldType($type, $key);

				try {
					$this->enterScope($context, $value, $fieldType, $key);
				} catch(CircularException $ex) {
					// if data type can refer then avoid circularException.
					if(!$fieldType->isType(NormalizerTypes::TYPE_REFERENCABLE)) {
						throw new \RuntimeException(sprintf('Circular reference cannot be solved. Please specify identifier(s) of "%s" on Path("%s")', $fieldType->getName(), $context->getPathInCurrentScope($key)), 0, $ex);
					}

					$fieldType = new ReferenceType($fieldType);
					$this->enterScope($context, null, $fieldType, $key);
				}
				$value = $context->getNormalizer()->normalize($value, $fieldType, $context);

				$this->leaveScope($context);
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

		// Convert Scalar value to indentifier array if possible
		if(is_scalar($data) && $type->isType(NormalizerTypes::TYPE_REFERENCABLE)) {
			$ids = $type->getIdentifierFields();
			if(1 == count($ids)) {
				$data = array(reset($ids) => $data);
			}
		}

		// Convert data before denormalize
		if(is_array($data)) {
			array_walk($data, function(&$value, $key, $data) {
				list($type, $context) = $data;
				// Field Type
				$fieldType = $context->getFieldType($type, $key);
				//if($fieldType = $context->getFieldType($type, $key)) {
				//	$fieldType = $context->getTypeRegistry()->getType($fieldType);
				//} else {
				//	$fieldType = $context->getTypeRegistry()->guessType($value);
				//}
				
				$context->enterScope($value, $fieldType, $key);
				// 
				$value = $context->getNormalizer()->denormalize($value, $fieldType, $context);

				$this->leaveScope($context);

			}, array($type, $context));
		}
		
		// after all denormalize child fields, denormalize the data. 
		// But first check the pool if the data exists
		$object = null;
		// Fixme: cause ArrayAccessStrategy extends this class, instance type validation is required. 
		$reference = null;
		if($type->isType(NormalizerTypes::TYPE_REFERENCABLE)) {
			$reference = new ReferenceType($type);
			
			$fields = $reference->getIdentifierFields();
			$identifiers = array_intersect_key($data, array_flip($fields));

			if(count($identifiers) == count($fields)) {
				$object = $context->getDataPool()->get($type, $identifiers);
			}
		}

		$denormalized = null;
		// check if the data is already denormalized
		if(is_object($data) && $type->isValidData($data)) {
			$denormalized = $data; 
		} else {
			$denormalized = $this->doDenormalize($data, $type, $context, $object);
		}

		if($reference) {
			$context->getDataPool()->add($type, $denormalized);
		}

		return $denormalized;
	}

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
