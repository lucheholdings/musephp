<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Coding;

use Erato\Core\CodingStandard;
use Clio\Component\Util\Grammer\Grammer;


class CustomizableCodingStandard extends CodingStandard 
{
	const RULE_PASCALIZE = 'pascal';
	const RULE_SNAKIZE   = 'snake';
	const RULE_CAMELIZE  = 'camel';

	private $namingFormats = array();

	public function __construct(array $rules = array())
	{
		// set default namingFormats
		$this->namingFormats	= array_replace(array(
				self::NAMING_CLASS           => self::RULE_PASCALIZE,
				self::NAMING_PROPERTY        => self::RULE_CAMELIZE,
				self::NAMING_METHOD          => self::RULE_CAMELIZE,
				self::NAMING_ARRAY_FIELD     => self::RULE_SNAKIZE,
				self::NAMING_ACCESSOR_FIELD  => self::RULE_SNAKIZE,
			), $rules);
	}

	public function setNamingFormat($naming, $format)
	{
		$this->namingFormats[$naming] = $format;
	}

	public function getNamingFormat($naming)
	{
		if(!isset($this->namingFormats[$naming])) 
			throw new \InvalidArgumentException(sprintf('Unknown format type "%s".', $naming));
		return $this->namingFormats[$naming];
	}

	public function formatNaming($naming)
	{
		$args = func_get_args();
		$format = $this->getNamingFormat(array_shift($args));
		return $this->doFormat($format, $args);
	}

	protected function doFormat($formatType, array $name)
	{
		switch($formatType) {
		case self::RULE_SNAKIZE: 
			return Grammer::snakize(implode('_', $name));
		case self::RULE_PASCALIZE: 
			return Grammer::pascalize(implode('_', $name));
		case self::RULE_CAMELIZE: 
			return Grammer::camelize(implode('_', $name));
		default:
			throw new \InvalidArgumentException(sprintf('Format type "%s" is not valid type.', $formatType));
		}
	}
}

