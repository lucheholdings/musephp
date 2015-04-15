<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\FieldAccessor;
use Clio\Component\Util\Accessor\Field as Fields;
use Clio\Component\Util\Accessor\DataAccessor;
use Clio\Component\Util\Metadata;

/**
 * FieldContainerSchemaAccessor 
 *   Commonly, we use this type of SchemaAccessor. 
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldContainerSchemaAccessor extends AbstractSchemaAccessor implements Fields\MultiFieldAccessor 
{
    /**
     * fieldAccessors 
     * 
     * @var Fields\FieldAccessorChain 
     * @access private
     */
    private $fieldAccessors;

    /**
     * __construct 
     * 
     * @param Metadata\Schema $schema 
     * @param array $fields 
     * @param array $options 
     * @access public
     * @return void
     */
    public function __construct(Metadata\Schema $schema, array $fieldAccessors = array(), array $options = array())
    {
        parent::__construct($schema, $options);

        $this->fieldAccessors = new Fields\FieldAccessorChain($fieldAccessors);
    }

    /**
     * setFieldAccessors 
     * 
     * @param array $accessors 
     * @access public
     * @return void
     */
    public function setFieldAccessors(array $accessors)
    {
        $this->fieldAccessors = new Fields\FieldAccessorChain($accessors);
        return $this;
    }

    /**
     * getFieldAccessors 
     * 
     * @access public
     * @return void
     */
    public function getFieldAccessors()
    {
        return $this->fieldAccessors->getAccessors();
    }

    /**
     * addFieldAccessor 
     * 
     * @param FieldAccessor $fieldAccessor 
     * @access public
     * @return void
     */
    public function addFieldAccessor(FieldAccessor $fieldAccessor)
    {
        $this->fieldAccessors->addAccessor($fieldAccessor);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get($container, $field)
    {
        return $this->fieldAccessors->get($container, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function set($container, $field, $value)
    {
        return $this->fieldAccessors->set($container, $field, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function isNull($container, $field)
    {
        return $this->fieldAccessors->isNull($container, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function clear($container, $field)
    {
        return $this->fieldAccessors->clear($container, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function getFieldNames($container = null)
    {
        return $this->fieldAccessors->getFieldNames($container);
    }

    /**
     * {@inheritdoc}
     */
    public function getFieldValues($container)
    {
        return $this->fieldAccessors->getFieldValues($container);
    }

    /**
     * {@inheritdoc}
     */
    public function existsField($container, $field)
    {
        return $this->fieldAccessors->existsField($container, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function isSupportedAccess($container, $field, $accessType)
    {
        return $this->fieldAccessors->isSupportedAccess($container, $field, $accessType);
    }
}

