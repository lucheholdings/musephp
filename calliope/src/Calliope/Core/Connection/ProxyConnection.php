<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Connection;

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
	public function __construct(Connection $connection = null)
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
        return $this->getConnection()->getConnectFrom();
    }

	/**
	 * {@inheritdoc}
	 */
	public function create($model)
    {
        return $this->getConnection()->create($model);
    }

	/**
	 * {@inheritdoc}
	 */
	public function update($model)
    {
        return $this->getConnection()->update($model);
    }

	/**
	 * {@inheritdoc}
	 */
	public function delete($model)
    {
        return $this->getConnection()->delete($model);
    }

	/**
	 * {@inheritdoc}
	 */
	public function reload($model)
    {
        return $this->getConnection()->reload($model);
    }

	/**
	 * {@inheritdoc}
	 */
	public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getConnection()->findBy($criteria, $orderBy, $limit, $offset);
    }

	/**
	 * {@inheritdoc}
	 */
	public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->getConnection()->findOneBy($criteria, $orderBy);
    }

	/**
	 * {@inheritdoc}
	 */
	public function countBy(array $criteria)
    {
        return $this->getConnection()->countBy($criteria);
    }

	/**
	 * {@inheritdoc}
	 */
	public function flush()
	{
		return $this->getConnection()->flush();
	}

	/**
	 * {@inheritdoc}
	 */
	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->getConnection(), $method), $args);
	}
}

