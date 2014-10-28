<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;
use Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection;

/**
 * FieldSchemaAccessorFactory 
 * 
 * @uses AccessorFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldSchemaAccessorFactory extends AbstractSchemaAccessorFactory implements SchemaAccessorFactory
{
	/**
	 * fieldAccessorFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldAccessorFactory;

	/**
	 * __construct 
	 * 
	 * @param FieldAccessorFactory $fieldAccessorFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(FieldAccessorFactory $fieldAccessorFactory = null)
	{
		if(!$fieldAccessorFactory) {
			$fieldAccessorFactory = new FieldAccessorFactoryCollection();
		}
		$this->fieldAccessorFactory = $fieldAccessorFactory;
	}

	/**
	 * createSchemaAccessor 
	 * 
	 * @param mixed $schema 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createSchemaAccessor($schema, array $options = array())
	{
		$fields = $this->createFieldAccessors($schema, $this->getFieldsFromSchema($schema));

		return new SimpleSchemaAccessor($schema, $fields, $options);
	}

	/**
	 * getFieldsFromSchema 
	 * 
	 * @param mixed $schema 
	 * @access protected
	 * @return void
	 */
	protected function getFieldsFromSchema($schema)
	{
		return array();
	}

	/**
	 * createFieldAccessors 
	 * 
	 * @param mixed $schema 
	 * @param mixed $fields 
	 * @access protected
	 * @return void
	 */
	protected function createFieldAccessors($schema, $fields)
	{
		$fieldAccessors = array();
		
		$fieldAccessorFactory = $this->getFieldAccessorFactory();
		if($fieldAccessorFactory) {
			foreach($fields as $field) {
				$fieldAccessors[$field] = $fieldAccessorFactory->createFieldAccessor($schema, $field);
			}
		}
		return $fieldAccessors;
	}

    /**
     * getFieldAccessorFactory 
     * 
     * @access public
     * @return void
     */
    public function getFieldAccessorFactory()
    {
        return $this->fieldAccessorFactory;
    }
    
    /**
     * setFieldAccessorFactory 
     * 
     * @param mixed $fieldAccessorFactory 
     * @access public
     * @return void
     */
    public function setFieldAccessorFactory($fieldAccessorFactory)
    {
        $this->fieldAccessorFactory = $fieldAccessorFactory;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedSchema($schema, array $options = array())
	{
		return true;
	}
}
