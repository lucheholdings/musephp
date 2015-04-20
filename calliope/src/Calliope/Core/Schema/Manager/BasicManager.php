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
    private $schema;

    private $connection;

    public function __construct(Schema $schema, Connection $connection = null)
    {
        $this->schema = $schema;
        $this->connection = null;

        // Update Connection
        $this->setConnection($connection);
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

	public function setConnection(Connection $connection)
	{
		$this->connection = $connection;

		$this->connection->connect($this);
		return $this;
	}
}

