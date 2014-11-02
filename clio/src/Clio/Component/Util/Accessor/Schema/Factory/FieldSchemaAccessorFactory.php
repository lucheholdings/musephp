<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;
use Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection;
use Clio\Component\Util\Accessor\Schema\SimpleSchemaAccessor;

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
class FieldSchemaAccessorFactory extends AbstractSchemaAccessorFactory 
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
	public function createSchemaAccessor(Schema $schema, array $options = array())
	{
		$fields = $this->createFieldAccessors($schema);

		return new SimpleSchemaAccessor($schema, $fields, $options);
	}

	/**
	 * createFieldAccessors 
	 * 
	 * @param mixed $schema 
	 * @param mixed $fields 
	 * @access protected
	 * @return void
	 */
	protected function createFieldAccessors(Schema $schema)
	{
		$fieldAccessors = array();
		
		$factory = $this->getFieldAccessorFactory();

		if($factory) {
			foreach($schema->getFields() as $field) {
				$accessor = $factory->createFieldAccessor($field);

				if($accessor instanceof SingleFieldAccessor) {
					$this->fieldAccessors->addAccessor($accessor, PRIORITY_SINGLE_FIELD);
				} else {
					$this->fieldAccessors->addAccessor($accessor, PRIORITY_MULTI_FIELD);
				}
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
    public function setFieldAccessorFactory(FieldAccessorFactory $fieldAccessorFactory)
    {
        $this->fieldAccessorFactory = $fieldAccessorFactory;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedSchema(Schema $schema, array $options = array())
	{
		return true;
	}
}