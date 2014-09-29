<?php
namespace Calliope\Framework\Core\Connection;

use Calliope\Framework\Core\Connection;

/**
 * ProxyConnection 
 * 
 * @uses Connection
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ProxyConnection implements Connection 
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
	 * @param Connection $connection 
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
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getConnectFrom()
    {
        return $this->connection->getConnectFrom();
    }

	/**
	 * {@inheritdoc}
	 */
	public function create($model)
    {
        return $this->connection->create($model);
    }

	/**
	 * {@inheritdoc}
	 */
	public function update($model)
    {
        return $this->connection->update($model);
    }

	/**
	 * {@inheritdoc}
	 */
	public function delete($model)
    {
        return $this->connection->delete($model);
    }

	/**
	 * {@inheritdoc}
	 */
	public function reload($model)
    {
        return $this->connection->reload($model);
    }

	/**
	 * {@inheritdoc}
	 */
	public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->connection->findBy($criteria, $orderBy, $limit, $offset);
    }

	/**
	 * {@inheritdoc}
	 */
	public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->connection->findOneBy($criteria, $orderBy);
    }

	/**
	 * {@inheritdoc}
	 */
	public function countBy(array $criteria)
    {
        return $this->connection->countBy($criteria);
    }

	/**
	 * {@inheritdoc}
	 */
	public function flush()
	{
		return $this->connection->flush();
	}

	/**
	 * {@inheritdoc}
	 */
	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->connection, $method), $args);
	}
}

