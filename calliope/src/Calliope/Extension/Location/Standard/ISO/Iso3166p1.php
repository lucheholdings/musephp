<?php
namespace Calliope\Extension\Location\Standard\ISO;

use Calliope\Standard\Core\Collection\TypeSpecifiedCodeCollection;
use Calliope\Standard\ISO\Iso3166p1 as BaseDefinition;

use Calliope\Extension\Location\Definition\DefinitionProviderInterface;

use Clio\Component\Loader\ArrayMergeLoader,
	Clio\Component\Loader\ArrayLoader,
	Clio\Component\Loader\YamlFileLoader;

/**
 * Iso3166p1 
 * 
 * @uses TypeSpecifiedCodeCollection
 * @uses DefinitionProviderInterface 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Iso3166p1 extends TypeSpecifiedCodeCollection implements DefinitionProviderInterface 
{
	/**
	 * createDefaultWithType 
	 * 
	 * @param mixed $type 
	 * @param mixed $resource 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createDefaultWithType($type)
	{
		$loader = new ArrayMergeLoader(array(
			new ArrayLoader(BaseDefinition::importDefaultDefinitions()),
			YamlFileLoader::createForDirs(array(__DIR__ . '/../../Resources/definitions')),
		), false);
		
		$data = $loader->loadArray('countries.yml');

		return new self(BaseDefinition::createFromArray($data), $type);
	}
}

