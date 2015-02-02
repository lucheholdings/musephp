<?php
namespace Application\Component\Tool\Normalizer;

class ReferencedValue 
{
	public function __construct(Type $type, $identifiers) 
	{
		$this->type  = $type;

		if (is_array($identifiers)) {
			foreach($identifiers as $field => $value) {
				$this->setIdentifier($field, $value);
			}
		} else {
			$this->setIdentifier(null, $value);
		}
	}

	public function setIdentifier($field, $value)
	{
		if(null === $field) {
			$fields = $this->getType()->getIdentifierFields();
			if(1 == count($fields)) {
				$field = reset($fields);
			}
		}

		if(!$field) {
			throw new \InvalidArgumentException('Identifier field is not specified.');
		}

		$this->identifiers[$field] = $value;
	}

	public function getIdentifierValues()
	{
		return $this->identifiers;
	}
}

