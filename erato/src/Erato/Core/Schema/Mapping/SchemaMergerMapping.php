<?php
namespace Erato\Core\Schema\Mapping;

use Clio\Component\Metadata\Mapping\AbstractMapping;
use Clio\Component\Metadata\Metadata;

use Erato\Core\Tool\AccessorMerger;
/**
 * SchemaMergerMapping 
 *    
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaMergerMapping extends AbstractMapping 
{
	/**
	 * _merger 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_merger;

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'merger';
	}
    
    /**
     * getMerger 
     * 
     * @access public
     * @return void
     */
    public function getMerger()
    {
		if(!$this->_merger) {
			$ignoreFields = $this->getIgnoreFields();

			$ids = $this->getMetadata()->getMapping('identifier')->getFieldNames();
			$ignoreFields = array_merge($ignoreFields, $ids);

			$mergeArray = $this->getOption('merge_array', true);

			$this->_merger = new AccessorMerger($this->getMetadata(), $ignoreFields, $mergeArray);
		}
        return $this->_merger;
    }

	public function merge()
	{
		return call_user_func_array(array($this->getMerger(), 'merge'), func_get_args());
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

