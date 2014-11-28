<?php
namespace Clio\Component\Util\Metadata\Field;

use Clio\Component\Util\Metadata\AbstractMetadata;
use Clio\Component\Util\Metadata\FieldMetadata;
use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Metadata\Mapping\Collection as MappingCollection;

/**
 * AbstractFieldMetadata 
 * 
 * @uses FieldMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFieldMetadata extends AbstractMetadata implements FieldMetadata 
{
	/**
	 * {@inheritdoc}
	 */
	private $schemaMetadata;

	/**
	 * {@inheritdoc}
	 */
	private $name;

	/**
	 * {@inheritdoc}
	 */
	private $type;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(SchemaMetadata $schema = null, $name, $type = Type::TYPE_MIXED)
	{
		$this->schemaMetadata = $schema;
		$this->name = $name;

		if($type instanceof Type) {
			$this->type = $type;
		} else {
			$this->type = new Type($type);
		}
	}
    
    /**
     * {@inheritdoc}
     */
    public function getSchemaMetadata()
    {
        return $this->schemaMetadata;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setSchemaMetadata(SchemaMetadata $schemaMetadata)
    {
        $this->schemaMetadata = $schemaMetadata;
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType(Type $type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


	public function serialize()
	{
		return serialize(array(
			$this->type,
			$this->name,
			$this->getMappings()->toArray()
		));
	}

	public function unserialize($serialized)
	{
		$data = unserialize($serialized);
		if(!$data) {
			throw new \RuntimeException(sprintf('Failed to unserialize "%s"', __CLASS__));
		}
		list(
			$this->type,
			$this->name,
			$mappings
		) = $data;

		$this->setMappings(new MappingCollection($mappings));
	}
}

