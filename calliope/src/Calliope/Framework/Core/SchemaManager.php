<?php
namespace Calliope\Framework\Core;

use Calliope\Framework\Core\Connection;
use Clio\Component\Schemifier\SchemifierInterface;
use Calliope\Framework\Core\Model\SchemaModelInterface;

use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Calliope\Framework\Core\Connection\Paging\ConnectionFetchPager;

/**
 * SchemaManager 
 *   SchemaManager is a Manager which bind the concepts of
 *    - ClassMetadata
 *    - FlexibleSchema (Tags and Attributes)
 *    - Schemifier
 *   and so on.
 * 
 *   SchemaManager provides functions to short-cut to call those
 *   conceptual functionalities.
 *   SchemaManager pool the Schema Model via Connections. 
 * 
 * @uses SchemaManagerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaManager implements SchemaManagerInterface
{
	/**
	 * classMetadata 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $classMetadata;

	/**
	 * connection
	 *   Connection is a pipe between "Managers" or "Manager and Client"
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $connection;

	/**
	 * _schemifier 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $_schemifier;

	/**
	 * __construct 
	 * 
	 * @param ClassMetadataInterface $classMetadata 
	 * @param Connection $connection 
	 * @param SchemifierInterface $schemifierFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadata $classMetadata)
	{
		$this->classMetadata = $classMetadata;
		$this->connection = null;
		$this->_schemifier = null;
	}

	/**
	 * create 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function create($model)
	{
		$model = $this->getConnection()->create($model);

		$this->getConnection()->flush();

		return $model;
	}

	/**
	 * delete 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function delete($model)
	{
		$model = $this->getConnection()->delete($model);

		$this->getConnection()->flush();

		return $model;
	}

	/**
	 * update 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function update($model)
	{
		$model = $this->getConnection()->update($model);

		$this->getConnection()->flush();

		return $model;
	}

	public function updateMulti($collection)
	{
		foreach($collection as $model) {
			$this->getConnection()->create($model);
		}

		$this->getConnection()->flush();

		return $collection;
	}

	public function createMulti($collection)
	{
		foreach($collection as $model) {
			$this->getConnection()->create($model);
		}

		$this->getConnection()->flush();

		return $collection;
	}

	/**
	 * reload 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function reload($model)
	{
		return $this->getConnection()->reload($model);
	}

	/**
	 * findBy
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
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
	 * findOneBy
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		$result = $this->getConnection()->findOneBy($criteria, $orderBy);

		return $result;
	}

	/**
	 * countBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	public function countBy(array $criteria) 
	{
		return $this->getConnection()->countBy($criteria);
	}
    
    /**
     * Get connection.
     *
     * @access public
     * @return connection
     */
    public function getConnection()
    {
		if(!$this->connection) {
			$this->connection = new NullConnection();
		}
        return $this->connection;
    }
    
    /**
     * connect
     * 
     * @param Connection $connection 
     * @access public
     * @return void
     */
    public function connect(Connection $connection)
    {
        $this->connection = $connection;
		$this->connection->setConnectFrom($this);

        return $this;
    }
    
    /**
     * Get schemifier.
     *
     * @access public
     * @return schemifier
     */
    public function getSchemifier()
    {
		if(!$this->_schemifier) {
			if(!$this->getClassMetadata()->hasMapping('schemifier')) {
				throw new \Clio\Component\Exception\RuntimeException('Schema dose not have a schemifier.');
			}

			$this->_schemifier = $this->getClassMetadata()->getMapping('schemifier')->getSchemifier();
		}
        return $this->_schemifier;
    }

    /**
     * Get classMetadata.
     *
     * @access public
     * @return classMetadata
     */
    public function getClassMetadata()
    {
		return $this->classMetadata;
    }

	/**
	 * getClassSchemaMapping
	 * 
	 * @access public
	 * @return SchemaClassMetadataExtension
	 */
	public function getClassSchemaMapping()
	{
		return $this->getClassMetadata()->getMapping('calliope_scheme');
	}
    
    /**
     * Set classMetadata.
     *
     * @access public
     * @param classMetadata the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMetadata($classMetadata)
    {
        $this->classMetadata = $classMetadata;
        return $this;
    }

	/**
	 * getClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClass()
	{
		return $this->getClassMetadata()->getReflectionClass();
	}

	/**
	 * getFieldAccessor
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldAccessor()
	{
		return $this->getClassMetadata()->getMapping('field_accessor')->getAccessor();
	}

	/**
	 * initModel 
	 * 
	 * @param mixed $model 
	 * @access public
	 A
	 * @return void
	 */
	public function initModel($model)
	{
		if(is_array($data) || $data instanceof \Traversable) {
			foreach($data as $v) {
				$this->doInitModel($v);
			}
		} else {
			$this->doInitModel($data);
		}
	}

	/**
	 * doInitModel 
	 * 
	 * @param mixed $metadata 
	 * @access protected
	 * @return void
	 */
	protected function doInitModel($model)
	{	
		if($model instanceof AccessorAwarable) {
			if(!$this->getPropertyAccessor()) {
				throw new \Exception('PropertyAccessor is not intialized yet.');
			}
			$model->setAccessor($this->getPropertyAccessor());
		}
	}

	/**
	 * createModelBuilder 
	 * 
	 * @access public
	 * @return void
	 */
	public function createModelBuilder()
	{
		return $this->getClassMetadata()->getMapping('calliope_scheme')->createBuilder();
	}

	/**
	 * createModel 
	 * 
	 * @access public
	 * @return void
	 */
	public function createModel()
	{
		return $this->getClassMetadata()->getMapping('calliope_scheme')->getComponentFactory()->createArgs(func_get_args());
	}

	/**
	 * schemify 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function schemify($data)
	{
		return $this->getSchemifier()->schemify($data);
	}

	/**
	 * merge 
	 * 
	 * @access public
	 * @return void
	 */
	public function merge()
	{
		return $this->getClassSchemaMapping()->getMerger()->invokeArgs(func_get_args());
	}

	/**
	 * replace 
	 * 
	 * @access public
	 * @return void
	 */
	public function replace()
	{
		return $this->getClassSchemaMapping()->getReplacer()->invokeArgs(func_get_args());
	}
}
