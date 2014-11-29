<?php
namespace Clio\Component\Util\Attribute;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Validator\SubclassValidator;

class SimpleAttributeMap extends Map implements AttributeMap
{
	protected function initContainer(array $values)
	{
		$this
			->enableStorageValidation()
			->setValueValidator(new SubclassValidator('Clio\Component\Util\Attribute\Attribute'))
		;
		parent::initContainer($values);
	}

	public function getOwner()
	{
		return $this->owner;		
	}

	public function setOwner(AttributeMapAware $owner)
	{
		$this->owner = $owner;
	}

	public function set($key, $value)
	{
		$value->setOwner($owner);
		return parent::set($key, $value);
	}
}

