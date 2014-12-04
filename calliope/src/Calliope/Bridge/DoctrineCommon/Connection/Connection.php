<?php
namespace Calliope\Bridge\DoctrineCommon\Connection;

use Calliope\Core\Connection as ConnectionInterface,
	Calliope\Core\Connection\CRUDConnection
;
use Doctrine\Common\Persistence\ObjectManager,
	Doctrine\Common\Persistence\ObjectRepository;

use Calliope\Core\Connection\AbstractConnection;

use Calliope\Core\Exception\DuplicateException;
use Calliope\Core\Exception\UnsupportedException;

/**
 * Connection 
 * 
 * @uses Connection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class Connection extends AbstractConnection implements ConnectionInterface, CRUDConnection
{
	/**
	 * repository 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $repository;

	/**
	 * classMetadata 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $classMetadata;

	/**
	 * disconnect 
	 * 
	 * @access public
	 * @return void
	 */
	public function disconnect()
	{
		parent::disconnect();

		$this->repository = null;
		$this->classMetadata = null;
	}

	/**
	 * delete 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function delete($model)
	{
		$entity = $this->getConnectTo()->findOneBy($this->getIdentifiers($model));
		$this->getObjectManager()->remove($entity);

		$this->doFlush();

		return $entity;
	}

	/**
	 * create
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function create($model)
	{
		try {
			$om = $this->getObjectManager();

			$escapedCascades = array();
			// once persist only the entity
			$metadata = $this->getDoctrineClassMetadata();
			$ref = new \ReflectionObject($model);

			foreach($metadata->associationMappings as $field => $assoc) {
				if($assoc['isCascadePersist']) {
					$property = $ref->getProperty($field);
					$property->setAccessible(true);
					$escapedCascades[$field] = $property->getValue($model);
					$property->setValue($model, null);
				}
			}

			$om->persist($model);
			$this->doFlush();

			// after persist the entity, then re-relate then collections
			// and flush it.
			if(0 < count($escapedCascades)) {
				foreach($escapedCascades as $field => $value) {
					$property = $ref->getProperty($field);
					$property->setAccessible(true);
					$escapedCascades[$field] = $property->setValue($model, $value);
				}

				$om->persist($model);
				$this->doFlush();
			}
			return $model;
		} catch(DuplicateException $ex) {
			throw new DuplicateException(get_class($model), array(), 0, $ex);
		}
	}

	/**
	 * update
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function update($model)
	{
		// Get the original Entity from the Database which matched with the given model identifiers.
		$entity = $this->getConnectTo()->findOneBy($this->getIdentifiers($model));

		$model = $this->getConnectFrom()->merge($entity, $model);

		try {
			$this->doFlush();
		} catch(DuplicateException $ex) {
			throw new DuplicateException(get_class($model), array(), 0, $ex);
		}

		return $model;
	}

	public function flush()
	{
		return array();
	}

	/**
	 * doFlush
	 * 
	 * @param mixed $model 
	 * @access protected
	 * @return void
	 */
	protected function doFlush()
	{
		try {
			$this->getObjectManager()->flush();
			// Detach objects
			//$this->getObjectManager()->clear();
		} catch(\Doctrine\DBAL\DBALException $ex) {
			$prev = $ex->getPrevious();
			if($prev instanceof \PDOException) {
				$code = $prev->getCode();
				if($code == '23000') {
					if(1062 == $prev->errorInfo[1]) {
						throw new DuplicateException(null, array(), 0, $ex);
					}
				} 
			}
			throw new \Exception('ConnectionException', 0, $ex);
		}
	}

	/**
	 * reload 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function reload($model)
	{
		//fixme
		$ids = $this->getIdentifiers($model);

		return $this->getRepository()->findOneBy($ids);
	}

	/**
	 * findBy
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$models = $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
		
		return $models;
	}

	/**
	 * findOneBy
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		$model = $this->getRepository()->findOneBy($criteria, $orderBy);
		
		return $model;
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
		if(method_exists($this->getRepository(), 'countBy')) 
		{
			return $this->getRepository()->countBy($criteria);
		}

		throw new UnsupportedException(sprintf('Repository "%s" for "%s" dose not support "countBy".', get_class($this->getRepository()), $this->getConnectFrom()->getStaticSchemaMetadata()->getName()));
	}
    
    /**
     * Get objectManager.
     *
     * @access public
     * @return objectManager
     */
    public function getObjectManager()
    {
        return $this->getConnectTo();
    }
    
    /**
     * Get repository.
     *
     * @access public
     * @return repository
     */
    public function getRepository()
    {
		if(!$this->repository) {
       		return $this->getObjectManager()->getRepository($this->getConnectFrom()->getStaticSchemaMetadata()->getName());
		}
		return $this->repository;
    }

	/**
	 * getIdentifiers 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getIdentifiers($model)
	{
		return $this->getDoctrineClassMetadata()->getIdentifierValues($model);
	}

	/**
	 * getDoctrineClassMetadata 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getDoctrineClassMetadata()
	{
		if(!$this->classMetadata) {
			$this->classMetadata = $this->getObjectManager()->getClassMetadata($this->getConnectFrom()->getStaticSchemaMetadata()->getName());
		}
		return $this->classMetadata;
	}
}

