<?php
namespace Calliope\Core\Schema\Manager;

use Calliope\Core\Schema\Manager;
use Calliope\Core\Connection;

/**
 * BasicManager 
 * 
 * @uses Manager
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicManager implements Manager 
{
    /**
     * schema 
     * 
     * @var mixed
     * @access private
     */
    private $schema;

    /**
     * connection 
     * 
     * @var mixed
     * @access private
     */
    private $connection;

    /**
     * options 
     * 
     * @var mixed
     * @access private
     */
    private $options;

    /**
     * __construct 
     * 
     * @param Schema $schema 
     * @param Connection $connection 
     * @param array $options 
     * @access public
     * @return void
     */
    public function __construct(Schema $schema, Connection $connection = null, array $options = array())
    {
        $this->schema = $schema;
        $this->options = $options;

        $this->connection = null;
        if($connection) {
            $this->setConnection($connection);
        }
    }

	/**
	 * {@inheritdoc}
	 */
	public function create($model) 
	{
		$model = $this->getConnection()->create($model);
		$this->getConnection()->flush();

		return $model;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createMulti($models)
	{
		foreach($models as $model) {
			$this->getConnection()->create($model);
		}

		$this->getConnection()->flush();
	}

	/**
	 * {@inheritdoc}
	 */
	public function update($model)
	{
		$model = $this->getConnection()->update($model);
		$this->getConnection()->flush();

		return $model;
	}

	/**
	 * {@inheritdoc}
	 */
	public function updateMulti($models)
	{
		foreach($models as $model) {
			$this->getConnection()->update($model);
		}

		$this->getConnection()->flush();
	}

	/**
	 * {@inheritdoc}
	 */
	public function delete($model)
	{
		$model = $this->getConnection()->delete($model);
		$this->getConnection()->flush();

		return $model;
	}

	/**
	 * {@inheritdoc}
	 */
	public function deleteMulti($models)
	{
		foreach($models as $model) {
			$this->getConnection()->delete($model);
		}

		$this->getConnection()->flush();
	}

    /**
     * save 
     * 
     * @access public
     * @return void
     */
	public function save()
	{
		$this->getConnection()->flush();
	}

	/**
	 * {@inheritdoc}
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		return $this->getConnection()->findOneBy($criteria, $orderBy);
	}

	/**
	 * {@inheritdoc}
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$pager = new ConnectionFetchPager(
			$this->getConnection(),
			$criteria, 
			$orderBy,
			$limit
		);

		return $pager->createPageAt($offset);
	}

	/**
	 * {@inheritdoc}
	 */
	public function countBy(array $criteria)
	{
		return $this->getConnection()->countBy($criteria);
	}
    
    /**
     * getSchema 
     * 
     * @access public
     * @return void
     */
    public function getSchema()
    {
        return $this->schema;
    }
    
	/**
	 * {@inheritdoc}
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

		$this->connection->connect($this);
		return $this;
	}
}

