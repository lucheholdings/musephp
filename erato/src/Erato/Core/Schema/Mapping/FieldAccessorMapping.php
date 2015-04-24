<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Field;
use Clio\Component\Util\Accessor\Field\Factory\Collection as FieldAccessorFactoryCollection;
use Clio\Component\Util\Accessor\Field as AccessorField;
use Clio\Component\Util\Accessor\AccessorAware;
/**
 * FieldAccessorMapping 
 * 
 * @uses AccessorMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorMapping extends AccessorMapping implements AccessorField, AccessorAware 
{
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
		$options['type'] = $type;
		parent::__construct($metadata, $options);
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

		if('ignore' == $fieldMetadata->getType()) {
			$this->setType('ignore');
		} else if($schemaMetadata->hasMapping('attribute_map') && ($fieldMetadata->getName() == $schemaMetadata->getMapping('attribute_map')->getFieldName())) {
			$attrMapping = $schemaMetadata->getMapping('attribute_map');
			$this->setType('attributes');
			$this->setOption('attribute_class', $attrMapping->getAttributeClass());

		} else if($schemaMetadata->hasMapping('tag_set') && ($fieldMetadata->getName() == $schemaMetadata->getMapping('tag_set')->getFieldName())) {
			$tagMapping = $schemaMetadata->getMapping('tag_set');
			$this->setType('tags');
			$this->setOption('tag_class', $tagMapping->getTagClass());
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
        return $this->getOption('type');
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
        $this->setOption('type', $type);
        return $this;
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

			$alias = $this->getAlias();

			if($this->getMetadata() instanceof Field\PropertyMetadata) {
				$accessorField = new AccessorField\PropertyField($this->getMetadata()->getReflectionProperty(), $alias);
			} else {
				$accessorField = new AccessorField\SchemaField($this->getMetadata()->getSchemaMetadata()->getMapping('accessor'), $this->getMetadata()->getName(), $alias);
			}
			$this->accessor = $this->getAccessorFactory()->createFieldAccessorByType($this->getType(), $accessorField, $this->getOptions());
		}

		return $this->accessor;
	}

	public function getAlias()
	{
		return $this->getOption('alias');
	}
}

