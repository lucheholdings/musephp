<?php
namespace Terpsichore\Client\Connection;

use Terpsichore\Client\Connection;

/**
 * StoredConnection 
 * 
 * @uses AbstractProxyConnection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StoredConnection extends PassThruConnection
{
	/**
	 * storage 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $storage;

	/**
	 * __construct 
	 * 
	 * @param Connection $connection 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, Storage $storage = null)
	{
		$this->validateConnection($connection);

		parent::__construct($connection);

		$this->storage = $storage;
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
		$this->validateConnection($connection);
		
		parent::setConnection($connection);
	}

	/**
	 * validateConnection 
	 * 
	 * @param Connection $connection 
	 * @access protected
	 * @return void
	 */
	protected function validateConnection(Connection $connection)
	{
		if(!$connection instanceof \Serializable) {
			throw new \InvalidArgumentException('StoredConnection requires Serializable as its original connection.');
		}
	}
    
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

	/**
	 * save 
	 * 
	 * @access public
	 * @return void
	 */
	public function save()
	{
		$this->getStorage()->save($this->getConnection()->serialize());
	}

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	public function load()
	{
		$this->getConnection()->unserialize($this->getStorage()->load());
	}
}

