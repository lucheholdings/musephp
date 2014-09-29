<?php
namespace Clio\Framework\Metadata\Mapping;

use Clio\Component\Util\FieldAccessor\Mapping\ClassMapping as AccessorClassMapping;

use Clio\Component\Pce\Metadata\AbstractClassMapping;
use Clio\Component\Pce\Metadata\ClassMetadata;
use Clio\Component\Util\FieldAccessor\Mapping\FieldMapping;

/**
 * FieldAccessorMapping 
 * 
 * @uses ClassExtensionMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorMapping extends AbstractClassMapping implements AccessorClassMapping
{
	/**
	 * accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessor;

	/**
	 * accessorBuilder 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessorBuilder;

	/**
	 * fields 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fields;

	/**
	 * __construct 
	 * 
	 * @param FieldAccessor $accessor 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadata $metadata, array $fields = array(), FieldAccessorBuilder $accessorBuilder = null)
	{
		parent::__construct($metadata);
		$this->fields = array();
		$this->accessorBuilder = $accessorBuilder;
		
		foreach($fields as $field) {
			$this->addField($field);
		}
	}
	
	/**
	 * Get accessor.
	 *
	 * @access public
	 * @return accessor
	 */
	public function getAccessor()
	{
		if(!$this->accessor) {
			$builder = $this->accessorBuilder;
			$builder->setClassMapping($this);

			$this->accessor = $builder->build();
		}
		
		return $this->accessor;
	}
	
	/**
	 * Set accessor.
	 *
	 * @access public
	 * @param accessor the value to set.
	 * @return mixed Class instance for method-chanin.
	 */
	public function setAccessorBuilder($accessorBuilder)
	{
		$this->accessorBuilder = $accessorBuilder;
		return $this;
	}

	/**
	 * setFeilds 
	 * 
	 * @param array $fields 
	 * @access public
	 * @return void
	 */
	public function setFields(array $fields)
	{
		if($this->accessor) {
			throw new RuntimeException(sprintf('FieldAccessor is already bound. So you cannot set fields.'));
		}

		$this->fields = array();
		foreach($fields as $field) {
			$this->addField($field);
		}

		return $this;
	}

	/**
	 * getFields 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFields()
	{
		return $this->fields;
	}

	/**
	 * addField 
	 * 
	 * @param FieldMapping $field 
	 * @access public
	 * @return void
	 */
	public function addField(FieldMapping $field) 
	{
		if($this->accessor) {
			throw new \Clio\Component\Exception\RuntimeException(sprintf('Field cannot be modified cause Accessor already built.'));
		}
		$this->fields[$field->getName()] = $field;
		return $this;
	}
}


