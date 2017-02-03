<?php
namespace Clio\Framework\Metadata\Mapping\Factory;

use Clio\Framework\Metadata\Mapping\SchemifierMapping;
use Clio\Component\Pce\Metadata\MappingFactory;
use Clio\Component\Pce\Metadata\Metadata;
use Clio\Component\Pce\Metadata\ClassMetadata;

use Clio\Component\Tool\Schemifier\Factory\SchemifierFactory;
/**
 * SchemifierMappingFactory 
 * 
 * @uses MappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemifierMappingFactory implements MappingFactory 
{
	/**
	 * schemifierFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemifierFactory;

	/**
	 * __construct 
	 * 
	 * @param SchemifierFactory $schemifierFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemifierFactory $schemifierFactory) 
	{
		$this->schemifierFactory = $schemifierFactory;
	}

	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function createMapping(Metadata $metadata, array $options = array())
	{
		if($metadata instanceof ClassMetadata) {
			$schemifier = $this->getSchemifierFactory()
				->createSchemifier($metadata->getReflectionClass())
			;

			// Create Mapping
			return new SchemifierMapping($schemifier);
		}
	}
    
    /**
     * Get schemifierFactory.
     *
     * @access public
     * @return schemifierFactory
     */
    public function getSchemifierFactory()
    {
        return $this->schemifierFactory;
    }
    
    /**
     * Set schemifierFactory.
     *
     * @access public
     * @param schemifierFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSchemifierFactory($schemifierFactory)
    {
        $this->schemifierFactory = $schemifierFactory;
        return $this;
    }

	/**
	 * getAlias 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAlias()
	{
		return 'schemifier';
	}
}

