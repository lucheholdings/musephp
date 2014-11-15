<?php
namespace Clio\Extra\Schemifier\Factory;

use Clio\Component\Tool\Schemifier\Factory\SchemifierFactory;
use Clio\Component\Tool\Normalizer\Normalizer;

use Clio\Component\Tool\Schemifier\FieldKeyMapperRegistry;

use Clio\Extra\Schemifier\NormalizerSchemifier;


/**
 * NormalizerSchemifierFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NormalizerSchemifierFactory extends ComponentFactory implements SchemifierFactory 
{
	/**
	 * normalizer 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $normalizer;

	/**
	 * mapperRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mapperRegistry;

	/**
	 * __construct 
	 * 
	 * @param Normalizer $normalizer 
	 * @access public
	 * @return void
	 */
	public function __construct(Normalizer $normalizer, FieldKeyMapperRegistry $mapperRegsitry = null)
	{
		$this->normalizer = $normalizer;
		$this->mapperRegistry = $mapperRegistry;
	}

	/**
	 * createSchemifier 
	 * 
	 * @param string|ReflectionClass $class
	 * @access public
	 * @return void
	 */
	public function createSchemifier($schema)
	{
		$schemifier = new NormalizerSchemifier($schema, $this->normalizer, $this->getFieldKeyMapperRegistry());

		return $schemifier;
	}
    
    /**
     * Get normalizer.
     *
     * @access public
     * @return normalizer
     */
    public function getNormalizer()
    {
        return $this->normalizer;
    }
    
    /**
     * Set normalizer.
     *
     * @access public
     * @param normalizer the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setNormalizer(Normalizer $normalizer)
    {
        $this->normalizer = $normalizer;
        return $this;
    }
    
    /**
     * getFieldKeyMapperRegistry 
     * 
     * @access public
     * @return void
     */
    public function getFieldKeyMapperRegistry()
    {
        return $this->mapperRegistry;
    }
    
    /**
     * setFieldKeyMapperRegistry 
     * 
     * @param FieldKeyMapperRegistry $mapperRegistry 
     * @access public
     * @return void
     */
    public function setFieldKeyMapperRegistry(FieldKeyMapperRegistry $mapperRegistry)
    {
        $this->mapperRegistry = $mapperRegistry;
        return $this;
    }
}

