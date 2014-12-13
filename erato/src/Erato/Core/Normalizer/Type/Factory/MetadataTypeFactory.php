<?php
namespace Erato\Core\Normalizer\Type\Factory;

use Clio\Component\Tool\Normalizer\Type\Factory\BasicFactory;
use Erato\Core\Normalizer\Type\MetadataType;
use Erato\Core\SchemaRegistry;
use Erato\Core\CodingStandard;


class MetadataTypeFactory extends BasicFactory 
{
	private $schemaRegistry;

	private $codingStandard;

	public function __construct(SchemaRegistry $registry)
	{
		$this->schemaRegistry = $registry;

		//parent::__construct();
	}

	protected function createObjectType($name)
	{
		if(!$this->getSchemaRegistry()->has((string)$name)) 
			return parent::createObjectType((string)$name);

		return new MetadataType($this->getSchemaRegistry()->get((string)$name), $this->getCodingStandard());
	}
    
    public function getSchemaRegistry()
    {
        return $this->schemaRegistry;
    }
    
    public function setSchemaRegistry(SchemaRegistry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }
    
    public function getCodingStandard()
    {
        return $this->codingStandard;
    }
    
    public function setCodingStandard(CodingStandard $codingStandard)
    {
        $this->codingStandard = $codingStandard;
        return $this;
    }
}

