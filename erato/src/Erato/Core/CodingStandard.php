<?php
namespace Erato\Core;

use Clio\Component\Util\Literal\CaseUtil,
    Clio\Component\Util\Literal\Psr1
;


class CodingStandard 
{
	const NAMING_ACCESSOR_FIELD    = 'accessor';
	const NAMING_CLASS             = 'class';
	const NAMING_PROPERTY          = 'property';
	const NAMING_METHOD            = 'method';
	const NAMING_ARRAY_FIELD       = 'array_field';

	public function formatNaming($naming)
	{
		$args = func_get_args();

		switch(array_shift($args)) {
		case self::NAMING_CLASS: 
			return Psr1::formatClassName(implode('_', $args));
		case self::NAMING_METHOD: 
			return Psr1::formatMethodName(implode('_', $args));
		case self::NAMING_PROPERTY: 
			return CaseUtil::camelize(implode('_', $args));
		case self::NAMING_ARRAY_FIELD: 
			return CaseUtil::snakize(implode('_', $args));
		case self::NAMING_ACCESSOR: 
			return CaseUtil::snakize(implode('_', $args));
		default:
			throw new \InvalidArgumentException(sprintf('Naming "%s" is unknown constraint.', $naming));
		}
	}
}

