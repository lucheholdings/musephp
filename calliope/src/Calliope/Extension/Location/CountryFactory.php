<?php
namespace Calliope\Extension\Location;

use Calliope\Extension\Location\Standard\ISO\Iso3166p1;
use Calliope\Extension\Location\Definition\DefinitionProviderInterface;
/**
 * CountryFactory 
 *   ex)
 *     CountryFactory::createFactory(Iso3166p1::TYPE_ALPHA2)->create('JP');
 *     CountryFactory::createFactory(Iso3166p1::TYPE_ALPHA3)->create('JPN');
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CountryFactory
{
	/**
	 * createFactory 
	 *   Factory create from ISO3166 part 1 
	 * @param mixed $type 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createFactoryWithIso3166p1($type)
	{
		$factory = new static();

		// Iso3166p1 with type specified.
		$factory->setCodeDefinition(Iso3166p1::createDefaultWithType($type));

		return $factory;
	}

	/**
	 * codeDefinition 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $codeDefinition;

	/**
	 * setCodeDefinition 
	 * 
	 * @param CountryCodeDefinitionInterface $codeDefinition 
	 * @access public
	 * @return void
	 */
	public function setCodeDefinition(DefinitionProviderInterface $codeDefinition)
	{
		$this->codeDefinition = $codeDefinition;
	}

	/**
	 * create 
	 * 
	 * @param mixed $country 
	 * @access public
	 * @return void
	 */
	public function create($countryCode)
	{
		//
		$definition = $this->getCountryDefinition($countryCode);

		if(!$definition) {
			throw new \RuntimeException(sprintf('Country "%s" is not defined', $countryCode));
		} else if(!$definition->has('class')) {
			// Create default Country Class 
			//throw new \RuntimeException(sprintf('class is not specified for country "%s"', $countryCode));

			$class = 'Calliope\Geo\Address\Core\Country';
		} else {
			$class = $definition->get('class');
		}


		$defaultClass = 'Calliope\Geo\Address\Core\Country';
		$class = new \ReflectionClass($class);
		if( ($defaultClass != $class->getName()) &&  
		    (!$class->isSubclassOf($defaultClass))) {
			throw new \RuntimeException(sprintf('Class "%s" is not a valid inherted class of "%s"',
				$class->getName(),
				$defaultClass
			));
		}
		
		// Get Definition attributes 
		$country = $class->newInstance(array_merge(array('name' => $countryCode), $definition->getAttributes()->toKeyValueArray()));

		return $country;
	}

	/**
	 * getCountryDefinition 
	 * 
	 * @param mixed $code 
	 * @access protected
	 * @return void
	 */
	protected function getCountryDefinition($countryCode)
	{
		return $this->codeDefinition->get($countryCode);
	}
}

