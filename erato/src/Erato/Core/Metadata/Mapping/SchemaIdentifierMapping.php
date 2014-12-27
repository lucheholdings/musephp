<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;

use Erato\Core\Tool\AccessorIdentifier;
/**
 * SchemaIdentifierMapping 
 *    
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaIdentifierMapping extends AbstractMapping 
{
	/**
	 * _fields 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_fields;

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'identifier';
	}
    
    /**
     * getFields 
     * 
     * @access public
     * @return void
     */
    public function getFields()
    {
		if(null == $this->_fields) {
			$fields = array();
			foreach($this->getMetadata()->getFields() as $field) {
				if($field->hasOption('identifier') && $field->getOption('identifier')) {
					$fields[] = $field;
				}
			}
			$this->_fields = $fields;
		}
        return $this->_fields;
    }

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldNames()
	{
		return array_map(function($field){
			return $field->getName();
		}, $this->getFields());
	}

	/**
	 * getIdentifierValues 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function getFieldValues($data)
	{
		$accessor = $this->getMetadata()->getMapping('accessor')->createDataAccessor($data);

		foreach($this->getFieldNames() as $field) {
			$ids[$field] = $accessor->get($field);
		}

		return $ids;
	}
}

