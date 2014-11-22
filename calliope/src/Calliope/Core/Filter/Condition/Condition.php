<?php
namespace Calliope\Core\Filter\Condition;

use Symfony\Component\EventDispatcher\Event;
use Calliope\Core\Connection;

/**
 * Condition 
 * 
 * @uses Event
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Condition extends Event 
{
	/**
	 * connection 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $connection;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
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
     * @param mixed $connection 
     * @access public
     * @return void
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }
}

