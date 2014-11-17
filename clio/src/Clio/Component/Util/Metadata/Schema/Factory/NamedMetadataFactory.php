<?php
namespace Clio\Component\Util\Metadata\Schema\Factory;

/**
 * NamedMetadataFactory 
 * 
 * @uses MetadataFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NamedMetadataFactory extends MetadataFactory
{
	private $schemas;

	public function __construct(array $schemas = array())
	{
		$this->schemas = array();
	}

	public function getSchema($name)
	{
		if(!isset($this->schemas[$name])) {
			throw new \InvalidArgumentException(sprintf('Unknown schema name "%s" is given.', $name));
		}
	}
}

