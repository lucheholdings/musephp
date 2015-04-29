<?php
namespace Clio\Component\Normalizer\ReferenceResolver;

class FieldReferenceResolver implements ReferenceResolver 
{
	private $fieldReflector;

	public function __construct(\Reflector $fieldReflector, Pool $pool)
	{
		if(!($fieldReflector instanceof \ReflectionProperty) && !($fieldReflector instanceof \ReflectionMethod)) {
			throw new \InvalidArgumentException('fieldReflecctor required ReflectionMethod or ReflectionProperty.');
		}
		$this->fieldReflector = $fieldReflector;
		$this->pool = $pool;
	}

	public function resolveReference($object)
	{
		$fieldReflector = $this->getFieldReflector();

		if(!$fieldReflector->getDeclaringClass()->isInstance($object)) {
			throw new \InvalidArgumentException(sprintf('Object "%s" is not an instance of "%s" to resolve reference.', get_class($object), $fieldReflector->class));
		}

		if($fieldReflector instanceof \ReflectionProperty) {
			$reference = $fieldReflector->getValue($object);
		} else if($fieldReflector instanceof \ReflectionMethod) {
			$reference = $fieldReflector->call($object);
		} else {
			throw new \RuntimeException(sprintf('Invalid Reflector "%s"', get_class($this->fieldReflector)));
		}

		return $reference;
	}

	public function resolveObject($reference)
	{
		if($this->getObjectPool()->hasKey($reference)) {
			return $this->getObjectPool()->get($this->getClass(), $reference);
		}
	}

	public function getClass()
	{
		return $this->getFieldReflector()->class;
	}
    
    public function getFieldReflector()
    {
        return $this->fieldReflector;
    }
    
    public function setFieldReflector(\Reflector $fieldReflector)
    {
		if(!($fieldReflector instanceof \ReflectionProperty) && !($fieldReflector instanceof \ReflectionMethod)) {
			throw new \InvalidArgumentException('fieldReflecctor required ReflectionMethod or ReflectionProperty.');
		}
        $this->fieldReflector = $fieldReflector;
        return $this;
    }
}

