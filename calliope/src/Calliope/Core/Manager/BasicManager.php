<?php
namespace Calliope\Core\Manager;

use Calliope\Core\Manager;
use Erato\Core\Manager\SchemaManager as BaseSchemaManager;
use Clio\Component\Util\Metadata\SchemaMetadata;
use Calliope\Core\Connection;
use Calliope\Core\Connection\Paging\ConnectionFetchPager;

/**
 * SchemaManager 
 *   Calliope SchemaManager is a Manager class for Usecase Schema Model .
 *   Each manager has different connection to connect with datastore.
 * 
 * @uses BaseSchemaManager
 * @uses Manager
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicManager extends BaseSchemaManager implements Manager
{
	private $connection;

	/**
	 * __construct 
	 * 
	 * @param SchemaMetadata $metadata 
	 * @param Connection $connection 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaMetadata $metadata, Connection $connection = null, Filters $filters = null)
	{
		parent::__construct($metadata);

		$this->connection = null;
		$this->filters    = $filters;

		$this->setConnection($connection);
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

	public function getStaticSchemaMetadata()
	{
		return $this->getSchemaMetadata()->getParent();
	}
}

