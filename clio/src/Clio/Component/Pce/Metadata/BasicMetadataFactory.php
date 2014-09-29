<?php
namespace Clio\Component\Pce\Metadata;

use Clio\Component\Pce\Construction\ComponentFactory;

/**
 * BasicMetadataFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicMetadataFactory extends ComponentFactory 
{
	/**
	 * mappingFactories 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mappingFactories;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($metadataClass, array $mappingFactories = array())
	{
		parent::__construct($metadataClass);

		$this->mappingFactories = new AliasedMappingFactoryCollection();

		if(!$this->getReflectionClass()->implementsInterface('Clio\Component\Pce\Metadata\Metadata')) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Class "%s" has to be implement Metadata interface.', $this->getReflectionClass()->getName()));
		}

		foreach($mappingFactories as $alias => $factory) {
			$this->mappingFactories->addFactory($factory, $alias);
		}
	}

	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args)
	{
		$metadata = parent::doCreate($args);

		$metadata->setMappingFactory($this->getMappingFactories());
		//$metadata->setMappings($this->createMetadataMappings($metadata));

		return $metadata;
	}
    
    /**
     * Get mappingFactories.
     *
     * @access public
     * @return mappingFactories
     */
    public function getMappingFactories()
    {
        return $this->mappingFactories;
    }

	public function addMappingFactory($factory, $alias = null)
	{
		$this->mappingFactories->addFactory($factory, $alias);

		return $this;
	}
}

