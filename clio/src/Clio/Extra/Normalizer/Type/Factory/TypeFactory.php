<?php
namespace Clio\Extra\Normalizer\Type\Factory;

class FieldTypeFactory extends BasicFactory 
{
	public function __construct(TypeRegistry $typeRegistry)
	{
		$this->typeRegistry = $typeRegistry;
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
		return new SchemaType($this->getTypeRegsitry()->get((string)$name), $this->getCodingStandard());
	}
    
    /**
     * getTypeRegsitry 
     * 
     * @access public
     * @return void
     */
    public function getTypeRegsitry()
    {
        return $this->schemaRegistry;
    }
    
    /**
     * setTypeRegsitry 
     * 
     * @param TypeRegsitry $schemaRegistry 
     * @access public
     * @return void
     */
    public function setTypeRegsitry(TypeRegsitry $schemaRegistry)
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

