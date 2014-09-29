<?php
namespace Calliope\Bridge\Doctrine\Connection;

use Calliope\Framework\Core\Connection;
use Doctrine\Common\Persistence\ObjectManager,
	Doctrine\Common\Persistence\ObjectRepository;

use Calliope\Framework\Core\SchemeModelProviderInterface;
use Calliope\Framework\Core\Connection\AbstractConnection;

use Calliope\Framework\Core\Exception\DuplicateException;

/**
 * DoctrineConnection
 * 
 * @uses Connection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class DoctrineConnection extends AbstractConnection implements Connection
{
	/**
	 * om 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $om;

	/**
	 * repository 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $repository;

	protected $_doctrineClassMetadata;
	/**
	 * __construct 
	 * 
	 * @param EntityRepository $repository 
	 * @access public
	 * @return void
	 */
	public function __construct(ObjectManager $om, ObjectRepository $repository, array $options = array())
	{
		$this->om = $om;
		$this->repository = $repository;

		parent::__construct($repository, $options);
	}

	/**
	 * validateConnectTo 
	 * 
	 * @param mixed $connectTo 
	 * @access protected
	 * @return void
	 */
	protected function validateConnectTo($connectTo)
	{
		return ($connectTo instanceof ObjectRepository);
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
		return $model;
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
		if(($this->getRepository() instanceof SchemeModelProviderInterface) ||
		  (method_exists($this->getRepository(), 'countBy'))) 
		{
			return $this->getRepository()->countBy($criteria);
		}

		throw new \Exception(sprintf('Repository "%s" for "%s" dose not support "countBy".', get_class($this->getRepository()), $this->getConnectFrom()->getClassMetadata()->getName()));
	}
    
    /**
     * Get objectManager.
     *
     * @access public
     * @return objectManager
     */
    public function getObjectManager()
    {
        return $this->om;
    }
    
    /**
     * Get repository.
     *
     * @access public
     * @return repository
     */
    public function getRepository()
    {
        return $this->getConnectTo();
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
		if(!$this->_doctrineClassMetadata) {
			$this->_doctrineClassMetadata = $this->getObjectManager()->getClassMetadata($this->getConnectFrom()->getClassMetadata()->getName());
		}
		return $this->_doctrineClassMetadata;
	}
}

