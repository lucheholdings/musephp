<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;

/**
 * AbstractSchemaAccessorFactory 
 * 
 * @uses AccessorFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSchemaAccessorFactory extends AbstractFactory implements SchemaAccessorFactory
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
		$this->fieldAccessorFactory = $fieldAccessorFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function doCreate(array $args)
	{
		$schema = array_shift($args);
		$options = array_shift($args) ?: array();
		return $this->createSchemaAccessor($schema, $options);
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
	 * isSupportedData 
	 * 
	 * @param mixed $data 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function isSupportedSchema($data);

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedFactory(array $args = array())
	{
		return $this->isSupportedSchema(array_shift($args));
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
}
