<?php
namespace Clio\Component\Util\Metadata;

class MetadataRegistry 
{
	const TYPE_SCHEMA   = 1;
	const TYPE_FIELD    = 2;

	public function getForce($metadata)
	{
		if($metadata instanceof Metadata) {
			return $metadata;
		} else if($metadata instanceof \ReflectionClass) {
			$this->getClassMetadata($metadata->getName(), $metadata);
		} else if(is_string($metadata)) {
			if(class_exists($metadata)) {
				$metadata = $this->getClassMetadata($metadata);
			} else {
				$metadata = $this->getCustomMetadata($metadata);
			}
		}
	}

	public function getClassMetadata($name, \ReflectionClass $prototype = null)
	{
		if($this->hasMetadata($name, self::TYPE_CLASS)) {
			$metadata = $this->getMetadata($name, self::TYPE_CLASS)
		} else {
			if(!$prototype) {
				$prototype = new \ReflectionClass($name);
			}
			$metadata = new ReflectionClassMetadata($prototype);
			$this->set($name, $metadata, self::TYPE_CLASS);
		}

		return $metadata;
	}

	public function getPropertyMetadata($name, \ReflectionProperty $property = null)
	{
	}

	public function getCustomMetadata($name)
	{
		if(!$this->hasMetadata($name, self::TYPE_CUSTOM)) {
			throw new \InvalidArgumentException(sprintf('Custom metadata "%s" is not exists.', $name));
		}

		return $this->getMetadata($name, self::TYPE_CUSTOM);
	}
}

