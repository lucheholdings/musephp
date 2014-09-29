<?php
namespace Calliope\Framework\Core\Factory;

use Clio\Component\Pce\Construction\InheritComponentFactory;
use Clio\Framework\Metadata\ClassMetadataRegistry;
use Calliope\Framework\Core\Connection\Factory\TypeConnectionFactory;
use Calliope\Framework\Core\Filter\Factory\FilterDelegatorFactory;

use Calliope\Framework\Core\Connection\FilterConnection;

/**
 * SchemeManagerComponentFactory 
 * 
 * @uses InheritComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemeManagerComponentFactory extends InheritComponentFactory
{
	const DEFAULT_MANAGER_CLASS = 'Calliope\Framework\Core\SchemeManager';

	/**
	 * classMetadataRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMetadataRegistry;

	/**
	 * typeConnectionFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $typeConnectionFactory;

	/**
	 * filterFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $filterFactory;

	/**
	 * __construct 
	 * 
	 * @param ClassMetadataRegistry $registry 
	 * @param TypeConnectionFactory $typeConnectionFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadataRegistry $registry, TypeConnectionFactory $typeConnectionFactory, FilterDelegatorFactory $filterFactory)
	{
		$this->classMetadataRegistry = $registry;
		$this->typeConnectionFactory = $typeConnectionFactory;
		$this->filterFactory = $filterFactory;

		parent::__construct(static::DEFAULT_MANAGER_CLASS);
	}
    
    /**
     * Get classMetadataRegistry.
     *
     * @access public
     * @return classMetadataRegistry
     */
    public function getClassMetadataRegistry()
    {
        return $this->classMetadataRegistry;
    }
    
    /**
     * Set classMetadataRegistry.
     *
     * @access public
     * @param classMetadataRegistry the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMetadataRegistry($classMetadataRegistry)
    {
        $this->classMetadataRegistry = $classMetadataRegistry;
        return $this;
    }
    
    /**
     * Get typeConnectionFactory.
     *
     * @access public
     * @return typeConnectionFactory
     */
    public function getTypeConnectionFactory()
    {
        return $this->typeConnectionFactory;
    }
    
    /**
     * Set typeConnectionFactory.
     *
     * @access public
     * @param typeConnectionFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTypeConnectionFactory($typeConnectionFactory)
    {
        $this->typeConnectionFactory = $typeConnectionFactory;
        return $this;
    }

	/**
	 * createSchemeManager 
	 * 
	 * @param mixed $schemeClass 
	 * @param mixed $connectionType 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createSchemeManager($schemeClass, $connectionType, $connectTo, array $filters = array(), array $options = array())
	{
		$schemeManager = null;

		$classMetadata = $this->getClassMetadata($schemeClass); 
		$connectionOptions = isset($options['connection']) ? $options['connction'] : array();

		$connectionOptions['scheme_class'] = $classMetadata;

		// Create SchemeManager
		if(isset($options['manager_class'])) {
			$schemeManager = $this->createInheritClass($options['manager_class'], $classMetadata);
		} else {
			$schemeManager = $this->create($classMetadata);
		}

		// Create FilterDelegator 
		$filter = $this->getFilterFactory()->createFilterDelegator((array)$filters);
		
		// Connect 
		if($schemeManager) {
			$schemeManager->connect($this->createConnection($connectionType, $connectTo, $connectionOptions, $filter));
		}
		
		return $schemeManager;
	}

	/**
	 * createConnection 
	 * 
	 * @param mixed $connectionType 
	 * @param mixed $connectTo 
	 * @access public
	 * @return void
	 */
	public function createConnection($connectionType, $connectTo, array $options = array(), $filter = null)
	{
		$connection = $this->getTypeConnectionFactory()->createTypeConnection($connectionType, $connectTo, $options);

		if($filter) {
			$connection = new FilterConnection($connection, $filter);
		}

		return $connection;
	}

	/**
	 * getClassMetadata 
	 * 
	 * @param mixed $schemeClass 
	 * @access public
	 * @return void
	 */
	public function getClassMetadata($schemeClass)
	{
		return $this->getClassMetadataRegistry()->get($schemeClass);
	}
    
    /**
     * Get filterFactory.
     *
     * @access public
     * @return filterFactory
     */
    public function getFilterFactory()
    {
        return $this->filterFactory;
    }
    
    /**
     * Set filterFactory.
     *
     * @access public
     * @param filterFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setFilterFactory($filterFactory)
    {
        $this->filterFactory = $filterFactory;
        return $this;
    }
}

