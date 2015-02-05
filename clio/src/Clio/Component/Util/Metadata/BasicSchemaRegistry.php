<?php
namespace Clio\Component\Util\Metadata;

use Clio\Component\Pattern\Registry\LoadableRegistry,
	Clio\Component\Pattern\Registry\EntryLoader
;
use Clio\Component\Util\Metadata\Type\BaseRegistry as TypeRegistry;
use Clio\Component\Util\Type\FieldType;

/**
 * BasicSchemaRegistry 
 * 
 * @uses LoadableRegistry
 * @uses SchemaRegistry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicSchemaRegistry extends LoadableRegistry implements SchemaRegistry 
{
	/**
	 * typeRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $typeRegistry;

	/**
	 * __construct 
	 * 
	 * @param MetadataFactory $metadataFactory 
	 * @param TypeRegistry $typeRegistry 
	 * @access public
	 * @return void
	 */
	public function __construct(EntryLoader $loader, TypeRegistry $typeRegistry = null)
	{
		parent::__construct($loader);

		$this->typeRegistry = $typeRegistry;
	}
	
	/**
	 * load 
	 * 
	 * @param mixed $key 
	 * @access protected
	 * @return void
	 */
	protected function load($key)
	{
		$loaded = parent::load($key);

		// Warmup Field Types
		foreach($loaded->getFields(false) as $field) {
			$this->loadType($field->getType());
		}

		return $loaded;
	}

	protected function loadType(FieldType $type)
	{
		$type->setType($this->getTypeRegistry()->get($type->getName()));

		//$internalTypes = $type->options->get('internal_types', array());

		//foreach($internalTypes as $internalType) {
		//	$this->loadType($internalType);
		//}
	}
    
    /**
     * getTypeRegistry 
     * 
     * @access public
     * @return void
     */
    public function getTypeRegistry()
    {
		if(!$this->typeRegistry) {
			throw new \RuntimeException('TypeRegistry is not initialized yet.');
		}
        return $this->typeRegistry;
    }
    
    /**
     * setTypeRegistry 
     * 
     * @param TypeRegistry $typeRegistry 
     * @access public
     * @return void
     */
    public function setTypeRegistry(TypeRegistry $typeRegistry)
    {
        $this->typeRegistry = $typeRegistry;
        return $this;
    }
}

