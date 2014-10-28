<?php
namespace Calliope\Framework\Core\Factory;

use Clio\Component\Pattern\Factory\ClassFactory;
use Clio\Component\Util\Metadata\SchemaMetadataRegistry;
use Calliope\Framework\Core\Connection\Factory\TypeConnectionFactory;
use Calliope\Framework\Core\Filter\Factory\FilterDelegatorFactory;

use Calliope\Framework\Core\Connection\FilterConnection;

/**
 * SchemeManagerComponentFactory 
 * 
 * @uses ClassFactory 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemeManagerComponentFactory extends ClassFactory 
{
	const DEFAULT_MANAGER_CLASS = 'Calliope\Framework\Core\SchemeManager';

	/**
	 * schemaMetadataRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $metadataRegistry;

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
	 * @param SchemaMetadataRegistry $registry 
	 * @param TypeConnectionFactory $typeConnectionFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaMetadataRegistry $registry, TypeConnectionFactory $typeConnectionFactory, FilterDelegatorFactory $filterFactory)
	{
		$this->schemaMetadataRegistry = $registry;
		$this->typeConnectionFactory = $typeConnectionFactory;
		$this->filterFactory = $filterFactory;

		parent::__construct(static::DEFAULT_MANAGER_CLASS);
	}
    
    /**
     * Get schemaMetadataRegistry.
     *
     * @access public
     * @return schemaMetadataRegistry
     */
    public function getSchemaMetadataRegistry()
    {
        return $this->schemaMetadataRegistry;
    }
    
    /**
     * Set schemaMetadataRegistry.
     *
     * @access public
     * @param schemaMetadataRegistry the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSchemaMetadataRegistry($schemaMetadataRegistry)
    {
        $this->schemaMetadataRegistry = $schemaMetadataRegistry;
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
			$schemeManager = $this->createClass($options['manager_class'], $classMetadata);
		} else {
			$schemeManager = $this->createClass(self::DEFAULT_MANAGER_CLASS, $classMetadata);
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
		return $this->getSchemaMetadataRegistry()->get($schemeClass);
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

