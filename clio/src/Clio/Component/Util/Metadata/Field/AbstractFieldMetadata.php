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


	public function serialize(array $extra = array())
	{
		$extra['type'] = $this->type;
		$extra['name'] = $this->name;

		return parent::serialize($extra);
	}

	public function unserialize($serialized)
	{
		$extra = parent::unserialize($serialized);

		$this->type = $extra['type'];
		$this->name = $extra['name'];

		return $extra;
	}
}

