<?php
namespace Clio\Component\Util\Type\Factory;

use Clio\Component\Pattern\Factory\Exception\UnsupportedException;

class TypeFactoryCollection 
{
	private $factories;

	public function createType($name)
	{
		$type = null;
		foreach($this as $factory) {
			try {
				$type = $factory->createType($name);
			} catch(UnsupportedException $ex) {
				continue;
			}
			break;
		}

		if(!$type) {
			throw new UnsupportedException(sprintf('Type "%s" is not supported.', $name));
		}

		return $type;
	}

	public function createTypeFromValue($value)
	{
		foreach($this as $factory) {
			try {
				$factory->createTypeFromValue($value);
			} catch(UnsupportedException $ex) {
				continue;
			}
			break;
		}
	}
}

