<?php
namespace Clio\Extra\Metadata\Mapping;

use Clio\Component\Metadata\Mapping\AbstractMapping;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Metadata\Field;
use Clio\Component\Accessor\Field\Factory\FieldAccessorFactoryCollection;
use Clio\Component\Accessor\Field as AccessorField;

/**
 * FieldAccessorMapping 
 * 
 * @uses AccessorMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorMapping extends AccessorMapping implements AccessorField 
{
	/**
	 * type 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $type;

	/**
	 * accessorFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessorFactory;

	/**
	 * accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessor;

	/**
	 * __construct 
	 * 
	 * @param mixed $type 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, $type, array $options = array())
	{
		$this->type = $type;

		parent::__construct($metadata);
	}

	/**
	 * clean 
	 * 
	 * @access public
	 * @return void
	 */
	public function clean()
	{
		$fieldMetadata = $this->getMetadata();
		$schemaMetadata = $this->getMetadata()->getSchemaMetadata();

		if($schemaMetadata->hasMapping('attribute_map') && ($fieldMetadata->getName() == $schemaMetadata->getMapping('attribute_map')->getFieldName())) {
			$this->type = 'attributes';

		} else if($schemaMetadata->hasMapping('tag_set') && ($fieldMetadata->getName() == $schemaMetadata->getMapping('tag_set')->getFieldName())) {
			$this->type = 'tags';
		}
	}
    
    /**
     * getType 
     * 
     * @access public
     * @return void
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * setType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize(array $extra = array())
	{
		$extra['type'] = $this->type;
		return parent::serialize($extra);
	}
	

	/**
	 * unserialize 
	 * 
	 * @param mixed $serialized 
	 * @access public
	 * @return void
	 */
	public function unserialize($serialized)
	{
		$extra = parent::unserialize($serialized);

		$this->type = $extra['type'];
		unset($extra['type']);

		return $exra;
	}
    
    public function getAccessorFactory()
    {
        return $this->accessorFactory;
    }
    
    public function setAccessorFactory(FieldAccessorFactoryCollection $accessorFactory)
    {
        $this->accessorFactory = $accessorFactory;
        return $this;
    }

	public function getAccessor()
	{
		if(!$this->accessor) {
			$alias = null;
			if($this->getMetadata() instanceof Field\PropretyMetadata) {
				$accessorField = new AccessorField\PropertyField($this->getMetadata()->getPropertyReflection());
			} else {
				$accessorField = new AccessorField\SchemaField($this->getMetadata()->getSchemaMetadata()->getMapping('accessor'), $this->getMetadata()->getName(), $alias);
			}
			$this->accessor = $this->getAccessorFactory()->createFieldAccessorByType($this->type, $accessorField, $this->getOptions());
		}

		return $this->accessor;
	}
}

