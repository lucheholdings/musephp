<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Util\Type as Types;
use Clio\Component\Tool\Normalizer\Normalizable;

class NormalizableStrategy extends InterfaceStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	protected function doNormalize($data, Type $type, Context $context)
	{
		if(!$data instanceof Normalizable) {
			throw new \Exception(sprintf('NormalizableStrategy is only able to normalize Normalizable instnace, but "%s" is given.', is_object($data) ? get_class($data) : gettype($data)));
		}

		// return normalized data.
		$normalized = $data->normalize();

		return $normalized;
	}

	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		// Construct Object
		if(!$object) {
			$object = $type->construct();
		}

		$scope = $context->enterScope($data, $type);

		// First denormalize each
		array_walk($data, function(&$value, $key, $data) {
			list($type, $context) = $data;
			// Field Type
			$fieldType = $context->getFieldType($type, $key);
			$fieldType = $context->getTypeResolver()->resolve($fieldType, array('data' => $value));
			$value = $context->getNormalizer()->denormalize($value, $fieldType, $context);
		}, array($type, $context));

		// then denormalize the object.
		$object->denormalize($data);

		return $object;
	}

	public function getInterfaceName()
	{
		return 'Clio\Component\Tool\Normalizer\Normalizable';
	}

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type)
	{
		return parent::canNormalize($data, $type);
	}
}
