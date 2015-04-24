<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;

use Erato\Core\Tool\AccessorReplacer;

/**
 * SchemaReplacerMapping 
 *    
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaReplacerMapping extends AbstractMapping 
{
	/**
	 * _replacer 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_replacer;

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'replacer';
	}
    
    /**
     * getReplacer 
     * 
     * @access public
     * @return void
     */
    public function getReplacer()
    {
		if(!$this->_replacer) {
			$ignoreFields = $this->getIgnoreFields();

			$ids = $this->getMetadata()->getMapping('identifier')->getFieldNames();
			$ignoreFields = array_merge($ignoreFields, $ids);

			$this->_replacer = new AccessorReplacer($this->getMetadata(), $ignoreFields);
		}

        return $this->_replacer;
    }

	public function replace()
	{
		return call_user_func_array(array($this->getReplacer(), 'replace'), func_get_args());
	}

	/**
	 * getIgnoreFields 
	 * 
	 * @access public
	 * @return void
	 */
	public function getIgnoreFields()
	{
		if($this->hasOption('ignore_fields'))
			return $this->getOption('ignore_fields');

		return array();
	}
}

