<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Service;

/**
 * StatefulSessionService
 *   StatefulSession means "the services' api is called sequencially, and share the some results in this session."
 *   Once this is authenticated, use the authenticated token to next api.
 * 
 *   Session might be a connection or multi-connection with http session id, or other. 
 *   It is depended on the sessionStorage.
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class StatefulSessionService extends CompositeService
{
	/**
	 * storage 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $storage;

    /**
     * getStorage 
     * 
     * @access public
     * @return void
     */
    public function getStorage()
    {
        return $this->storage;
    }
    
    /**
     * setStorage 
     * 
     * @param mixed $storage 
     * @access public
     * @return void
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
        return $this;
    }
}

