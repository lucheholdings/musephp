<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Schemifier\Factory;

use Clio\Component\Schemifier\Factory\SchemifierFactoryInterface;
use Clio\Component\Metadata\ClassMetadataInterface;

/**
 * ProxySchemifierFactory 
 * 
 * @uses SchemifierFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxySchemifierFactory implements SchemifierFactoryInterface 
{
	/**
	 * schemifierFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemifierFactory;

	/**
	 * classMetadataFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMetadataFactory;

	/**
	 * __construct 
	 * 
	 * @param SchemifierFactoryInterface $factory 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemifierFactoryInterface $schemifierFactory, ClassMetadataFactoryInterface $metadataFactory)
	{
		$this->schemifierFactory    = $schemifierFactory;
		$this->classMetadataFactory = $metadataFactory;
	}

	/**
	 * createSchemifier 
	 * 
	 * @param ClassMetadataInterface $metadata 
	 * @access public
	 * @return void
	 */
	public function createSchemifier(ClassMetadataInterface $metadata)
	{
		return $this->getSchemifierFactory()->createSchemifier($metaddata);
	}

	/**
	 * createSchemifierByClassName 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function createSchemifierByClassName($class)
	{
		$metadata = $this->getClassMetadataFactory()->createMetadata($class);
		return $this->getSchemifierFactory()->createSchemifier($metadata);
	}
    
    /**
     * Get schemifierFactory.
     *
     * @access public
     * @return schemifierFactory
     */
    public function getSchemifierFactory()
    {
        return $this->schemifierFactory;
    }
    
    /**
     * Set schemifierFactory.
     *
     * @access public
     * @param schemifierFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSchemifierFactory($schemifierFactory)
    {
        $this->schemifierFactory = $schemifierFactory;
        return $this;
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
}

