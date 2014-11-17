<?php
namespace Erato\Adapter\SymonyBundles\FrameworkBundle\Coding;

use Clio\Component\Util\Grammer\Grammer;

class CustomizableCodingStandard extends CodingStandard 
{
	private $namingFormats = array();

	public function __construct()
	{
		// set default namingFormats
		$this->namingFormats	= array(
			self::NAMING_CLASS        => 'pascal',
			self::NAMING_PROPERTY     => 'camel',
			self::NAMING_METHOD       => 'camel',
			self::NAMING_ARRAY_FIELD  => 'snake',
		);
	}

	public function setNamingFormat($naming, $format)
	{
		$this->namingFormats[$naming] = $format;
	}

	public function getNamingFormat($naming)
	{
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
		case 'snake': 
			return Grammer::snakize(implode('_', $name));
		case 'pascal': 
			return Grammer::pascalize(implode('_', $name));
		case 'camel': 
			return Grammer::camelize(implode('_', $name));
		default:
			throw new \InvalidArgumentException(sprintf('Format type "%s" is not valid type.', $formatType));
		}
	}
}

