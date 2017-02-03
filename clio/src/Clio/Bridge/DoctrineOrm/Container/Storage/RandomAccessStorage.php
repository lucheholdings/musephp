<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Bridge\DoctrineOrm\Container\Storage;

use Clio\Component\Util\Container\Storage\RandomAccessStorage as RandomAccessStorageInterface,
	Clio\Component\Util\Container\Storage\Dumpable
;

use Doctrine\ORM\EntityManager;

class RandomAccessStorage implements RandomAccessStorageInterface, Dumpable
{
	/**
	 * em 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $em;
	
	/**
	 * repository 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $repository;

	/**
	 * class 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $class;

	public function __construct(EntityManager $em, $class)
	{
		$this->em = $em;

		$this->repository = $this->em->getRepository($class);
		$this->class = $this->em->getClassMetadata($class);

		if(!$this->class->getReflectionClass()->implementsInterface('Clio\Component\Util\Pair\KeyValuePair')) {
			throw new \InvalidArgumentException('Entity must implements KeyValuePair to use as Map.');
		}
	}

	public function load()
	{
	}

	public function save()
	{
	}

	public function count()
	{
		return count($this->dump());
	}

	/**
	 * setAt 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setAt($key, $value)
	{
		$em = $this->getEntityManager();

		$entity = null;
		try {
			$entity = $this->getRepository()->findOneBy(array('key' => $key));
		} catch(\Doctrine\ORM\EntityNotFoundException $ex) {
			//
		}
		if(!$entity) {
			$entity = $this->getClass()->newInstance();
			$entity->setKey($key);
		}

		$entity->setValue($value);

		$em->persist($entity);
		$em->flush();
	}

	/**
	 * getAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getAt($key)
	{
		$entity = $this->getRepository()->findOneBy(array('key' => $key));

		return $entity->getValue();
	}

	/**
	 * removeAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeAt($key)
	{
		$entity = $this->getRepository()->findOneBy(array('key' => $key));

		$em = $this->getEntityManager();
		$em->remove($entity);
		$em->flush();
	}

	/**
	 * existsAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function existsAt($key)
	{
		try {
			$entity = $this->getRepository()->findOneBy(array('key' => $key));
		} catch(\Doctrine\ORM\EntityNotFoundException $ex) {
			$entity = false;
		}

		return (bool)$entity;
	}

	public function dump()
	{
		$collection = $this->getRepository()->findBy(array());

		$values = array();
		foreach($collection as $entity) {
			$values[$entity->getKey()] = $entity->getValue();
		}

		return $values;
	}

    
    public function getEntityManager()
    {
        return $this->em;
    }
    
    public function setEntityManager($em)
    {
        $this->em = $em;
        return $this;
    }
    
    public function getRepository()
    {
        return $this->repository;
    }
    
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }
}

