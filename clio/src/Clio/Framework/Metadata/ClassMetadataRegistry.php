<?php
namespace Clio\Framework\Metadata;

use Clio\Component\Pce\Metadata\ClassMetadata;

use Clio\Framework\Registry\ServiceRegistry;

/**
 * ClassMetadataRegistry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassMetadataRegistry extends ServiceRegistry
{
	/**
	 * classMetadataFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMetadataFactory;

	/**
	 * has 
	 * 
	 * @param mixed $class 
	 * @param mixed $acceptLoadable 
	 * @access public
	 * @return void
	 */
	public function has($class, $acceptLoadable = true)
	{
		$className = $this->getClassNameFor($class);

		$has = parent::has($className);

		if(!$has && $acceptLoadable) {
			// Try load the ClassMetadata.
			try {
				$has = (bool)$this->get($className);
			} catch(\Exception $ex) {
				// 
				$has = false;
			}
		}

		return $has;
	}

	/**
	 * get 
	 * 
	 * @param mixed $class 
	 * @param mixed $needLoad 
	 * @access public
	 * @return void
	 */
	public function get($class, $needLoad = true)
	{
		$className = $this->getClassNameFor($class);

		if(!parent::has($className) && $needLoad) {
			$this->set($className, $this->createClassMetadata($className));
		}

		return parent::get($className);
	}

	/**
	 * set 
	 * 
	 * @param mixed $class 
	 * @param ClassMetadata $metadata 
	 * @access public
	 * @return void
	 */
	public function set($class, $metadata)
	{
		parent::set($this->getClassNameFor($class), $metadata);
		return $this;
	}

	/**
	 * remove 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function remove($class)
	{
		$deleted = null;
		if(isset($this->classes[$class])) {
			$deleted = $this->classes[$class];
			unset($this->classes[$class]);
		}

		return $deleted;
	}

	/**
	 * getClassNameFor 
	 * 
	 * @param mixed $class 
	 * @access protected
	 * @return void
	 */
	protected function getClassNameFor($class)
	{
		if($class instanceof \ReflectionClass) {
			return $class->getName();
		} else if(is_object($class)){
			return get_class($class);
		} else if(is_string($class)) {
			return $class;
		}

		throw new \InvalidArgumentException(sprintf('Argument $class has to be a string classname, an instanceof class or the ReflectionClass.'));
	}

	protected function isValidService($service)
	{
		return ($service instanceof ClassMetadata);
	}
    
    /**
     * Get classMetadataFactory.
     *
     * @access public
     * @return classMetadataFactory
     */
    public function getClassMetadataFactory()
    {
        return $this->classMetadataFactory;
    }
    
    /**
     * Set classMetadataFactory.
     *
     * @access public
     * @param classMetadataFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMetadataFactory($classMetadataFactory)
    {
        $this->classMetadataFactory = $classMetadataFactory;
        return $this;
    }

	/**
	 * createClassMetadata 
	 * 
	 * @param mixed $className 
	 * @access public
	 * @return void
	 */
	public function createClassMetadata($className)
	{
		$factory = $this->getClassMetadataFactory();
		if(!$factory) {
			throw new \RuntimeException('ClassMetadata cannot be created without Factory.');
		}
		return $factory->createClassMetadata($className);
	}
}

