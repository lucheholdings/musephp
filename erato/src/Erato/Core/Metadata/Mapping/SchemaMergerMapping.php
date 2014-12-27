<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;

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
		if($this->_merger) {
			$this->_merger = new AccessorMerger($this->getSchema(), $this->getIgnoreFields());
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
		return array();
	}
}

