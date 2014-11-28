<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Accessor\Field\Factory\Collection as FieldAccessorFactoryCollection;
use Clio\Component\Util\Accessor\Field as AccessorField;
use Clio\Component\Util\Accessor\Field\NamedField;
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
	public function serialize()
	{
		return serialize(array(
			$this->type,
			$this->getOptions()
		));
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
		list(
			$this->type,
			$options
		) = unserialize($serialized);

		$this->setOptions($options);
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
			$accessorField = new NamedField($this->getMetadata()->getSchemaMetadata()->getMapping('accessor'), $this->getMetadata()->getName());
			$this->accessor = $this->getAccessorFactory()->createFieldAccessorByType($this->type, $accessorField, $this->getOptions());
		}

		return $this->accessor;
	}

	public function dumpConfig()
	{
		return array(
			$this->type,
			$this->getOptions()
		);
	}
}

