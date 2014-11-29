<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Pattern\Factory\AbstractFactory;
use Clio\Component\Util\Accessor\Field;
use Clio\Component\Util\Accessor\Field\Factory\Collection as FieldAccessorFactoryCollection;
use Clio\Component\Util\Accessor\Schema\SimpleSchemaAccessor;
use Clio\Component\Util\Accessor\AccessorAware;

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
	public function __construct(FieldAccessorFactoryCollection $fieldAccessorFactory = null)
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
		$factory = $this->getFieldAccessorFactory();

		$accessors = $namedCollection = new Field\NamedCollection();

		if($factory) {
			foreach($schema->getFields() as $field) {
				if($field instanceof AccessorAware) {
					$accessor = $field->getAccessor();
				} else {
					$accessor = $factory->createFieldAccessorWithoutType($field);
				}

				if($accessor instanceof Field\SingleFieldAccessor) {
					$namedCollection->addFieldAccessor($accessor);
				} else if($accessor instanceof Field\MultiFieldAccessor){
					if(!$accessors instanceof Field\ChainedFieldAccessor) {
						$accessors = new Field\ChainedFieldAccessor($namedCollection, $accessor);
					} else {
						$accessors->addNext($accessor);
					}
				}
				
			}
		}
		return $accessors;
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
    public function setFieldAccessorFactory(Field\FieldAccessorFactory $fieldAccessorFactory)
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
