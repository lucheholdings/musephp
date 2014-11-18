<?php
namespace Terpsichore\Client\Service;

use Terpsichore\Client\Connection;
use Terpsichore\Client\Request;

/**
 * GenericClientService 
 * 
 * @uses AbstractService
 * @uses ClientService
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GenericClientService extends AbstractService implements ClientService
{
	/**
	 * _connection
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_connection;

	/**
	 * __construct 
	 * 
	 * @param Connection $connection 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection = null, $name = null, array $options = array())
	{
		$this->_connection = $connection;

		parent::__construct($name, $options);
	}
	
	/**
	 * request 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function request(Request $request)
	{
		return $this->getConnection()->send($request);
	}

    /**
     * getConnection 
     * 
     * @access public
     * @return void
     */
    public function getConnection()
    {
        return $this->_connection;
    }
    
    /**
     * setConnection 
     * 
     * @param mixed $connection 
     * @access public
     * @return void
     */
    public function setConnection(Connection $connection)
    {
        $this->_connection = $connection;
        return $this;
    }

	/**
	 * __invoke 
	 *   If Service is CallableService, then invoke 
	 * @access protected
	 * @return void
	 */
	protected function __invoke()
	{
		if($this instanceof CallableService) {
			return call_user_func_array(array($this, 'call'), func_get_args()); 
		}
		throw new \RuntimeException(sprintf('Service "%s" is not invokable', __CLASS__));
	}
}

