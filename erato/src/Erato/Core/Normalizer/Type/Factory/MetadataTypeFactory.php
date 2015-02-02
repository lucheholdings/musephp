<?php
namespace Erato\Core\Normalizer\Type\Factory;

use Clio\Component\Tool\Normalizer\Type\Factory\BasicFactory;
use Erato\Core\Normalizer\Type\MetadataType;
use Erato\Core\SchemaRegistry;
use Erato\Core\CodingStandard;

/**
 * MetadataTypeFactory 
 * 
 * @uses BasicFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MetadataTypeFactory extends BasicFactory 
{
	/**
	 * schemaRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemaRegistry;

	/**
	 * codingStandard 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $codingStandard;

	/**
	 * __construct 
	 * 
	 * @param SchemaRegistry $registry 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaRegistry $registry)
	{
		$this->schemaRegistry = $registry;

		//parent::__construct();
	}

	/**
	 * createObjectType 
	 * 
	 * @param mixed $name 
	 * @access protected
	 * @return void
	 */
	protected function createObjectType($name, array $options = array())
	{
		if(!$this->getSchemaRegistry()->has((string)$name)) {
			return parent::createObjectType((string)$name);
		}

		return new MetadataType($this->getSchemaRegistry()->get((string)$name), $this->getCodingStandard());
	}
    
    /**
     * getSchemaRegistry 
     * 
     * @access public
     * @return void
     */
    public function getSchemaRegistry()
    {
        return $this->schemaRegistry;
    }
    
    /**
     * setSchemaRegistry 
     * 
     * @param SchemaRegistry $schemaRegistry 
     * @access public
     * @return void
     */
    public function setSchemaRegistry(SchemaRegistry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }
    
    /**
     * getCodingStandard 
     * 
     * @access public
     * @return void
     */
    public function getCodingStandard()
    {
        return $this->codingStandard;
    }
    
    /**
     * setCodingStandard 
     * 
     * @param CodingStandard $codingStandard 
     * @access public
     * @return void
     */
    public function setCodingStandard(CodingStandard $codingStandard)
    {
        $this->codingStandard = $codingStandard;
        return $this;
    }
}

