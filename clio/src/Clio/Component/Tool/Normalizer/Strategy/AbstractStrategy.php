<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy;
use Clio\Component\Tool\Normalizer\Type,
	Clio\Component\Tool\Normalizer\Type\ObjectType,
	Clio\Component\Tool\Normalizer\Type\ReferenceType
;
use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\CircularException;

abstract class AbstractStrategy implements Strategy
{
	private $options;

	public function __construct(array $options = array())
	{
		$this->options = $options;
	}

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

		$context->enterScope($data, $type);
		
		// normalize the data to array
		$normalized = $this->doNormalize($data, $type, $context);
		
		if(is_array($normalized)) {
			// recursively call normalize
			array_walk($normalized, function(&$value, $key, $data) {
				list($context, $type) = $data;

				$value = $context->getNormalizer()->normalize($value, null, $context);
			}, array($context, $type));
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
			array_walk($data, function(&$value, $key, $data) {
				list($type, $context) = $data;
				// Field Type
				if($fieldType = $type->getFieldType($key)) {
					$fieldType = $context->getTypeRegistry()->getType($fieldType);
				} else {
					$fieldType = $context->getTypeRegistry()->guessType($value);
				}
				// 
				$value = $context->getNormalizer()->denormalize($value, $fieldType, $context);
			}, array($type, $context));
		}
		
		$denormalized = $this->doDenormalize($data, $type, $context);

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
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

	public function getOption($name, $default = null) 
	{
		return isset($this->options[$name]) ? $this->options[$name] : $default;
	}

	public function setOption($name, $value)
	{
		$this->options[$name] = $value;
	}
}

