<?php
namespace Erato\Core\Schema\Mapping;

use Clio\Component\Metadata\Mapping\AbstractMapping;
use Clio\Component\Metadata\Metadata;

use Erato\Core\Tool\AccessorIdentifier;
/**
 * IdentifierMapping 
 *    
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class IdentifierMapping extends AbstractMapping 
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
				if($field->hasOption('identifier')) {
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

	public function hasFields()
	{
		return 0 < count($this->getFields());
	}

	public function validateValues(array $values)
	{
		$keys = array_keys($values);
		foreach($this->getFieldNames() as $field) {
			if(!in_array($keys, $field)) {
				return false;
			}
		}
		return true;
	}
}

