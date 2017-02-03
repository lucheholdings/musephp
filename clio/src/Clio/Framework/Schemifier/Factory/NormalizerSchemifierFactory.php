<?php
namespace Clio\Framework\Schemifier\Factory;

use Clio\Component\Tool\Schemifier\Factory\SchemifierFactory;
use Clio\Component\Tool\Normalizer\Normalizer;

use Clio\Component\Tool\Schemifier\FieldMapperRegistry;

use Clio\Framework\Schemifier\NormalizerSchemifier;


/**
 * NormalizerSchemifierFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NormalizerSchemifierFactory implements SchemifierFactory 
{
	/**
	 * normalizer 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $normalizer;

	/**
	 * fieldMapperRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldMapperRegistry;

	/**
	 * __construct 
	 * 
	 * @param Normalizer $normalizer 
	 * @access public
	 * @return void
	 */
	public function __construct(Normalizer $normalizer, FieldMapperRegistry $fieldMapperRegistry = null)
	{
		$this->normalizer = $normalizer;

		$this->fieldMapperRegistry = $fieldMapperRegistry;
	}

	/**
	 * createSchemifier 
	 * 
	 * @param string|ReflectionClass $class
	 * @access public
	 * @return void
	 */
	public function createSchemifier($class)
	{
		if(!$class instanceof \ReflectionClass) {
			$class = new \ReflectionClass($class);
		}

		$schemifier = new NormalizerSchemifier($class, $this->normalizer, $this->getFieldMapperRegistry());

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
     * getFieldMapperRegistry 
     * 
     * @access public
     * @return void
     */
    public function getFieldMapperRegistry()
    {
        return $this->fieldMapperRegistry;
    }
    
    /**
     * setFieldMapperRegistry 
     * 
     * @param FieldMapperRegistry $fieldMapperRegistry 
     * @access public
     * @return void
     */
    public function setFieldMapperRegistry(FieldMapperRegistry $fieldMapperRegistry)
    {
        $this->fieldMapperRegistry = $fieldMapperRegistry;
        return $this;
    }
}

