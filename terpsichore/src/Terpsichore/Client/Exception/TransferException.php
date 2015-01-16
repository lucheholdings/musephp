<?php
namespace Terpsichore\Client\Exception;

use Terpsichore\Core\Exception\TransferException as BaseException;
use Terpsichore\Client\Connection;
use Terpsichore\Core\Request;

/**
 * TransferException 
 * 
 * @uses BaseException
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TransferException extends BaseException 
{
	/**
	 * connection 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $connection;

	public function __construct(Connection $connection, Request $request, $response = null, $message = '', $code = 0, \Exception $prev = null)
	{
		$message = sprintf('Failed to transfer [%s]: %s', $request->getHeader('uri'), $message);
		parent::__construct($request, $response, $message, $code, $prev);
	}
    
    /**
     * getConnection 
     * 
     * @access public
     * @return void
     */
    public function getConnection()
    {
        return $this->connection;
    }
    
    /**
     * setConnection 
     * 
     * @param Connection $connection 
     * @access public
     * @return void
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
        return $this;
    }
}

