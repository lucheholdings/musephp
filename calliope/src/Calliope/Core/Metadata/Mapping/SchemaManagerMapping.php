<?php
namespace Calliope\Core\Metadata\Mapping;

use Clio\Extra\Metadata\Mapping\AbstractRegistryServiceMapping;
use Clio\Component\Util\Metadata\Metadata;
use Calliope\Core\Manager\SchemaManager;
use Calliope\Core\Manager\Factory\ClassFactory;

/**
 * SchemaManagerMapping 
 *    
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaManagerMapping extends AbstractRegistryServiceMapping 
{
	/**
	 * _managerClassFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_managerClassFactory;

	/**
	 * _manager 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_manager;

	/**
	 * __construct 
	 * 
	 * @param Metadata $metadata 
	 * @param Factory $managerClassFactory 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, $registry, $managerClass, $connection, ClassFactory $managerClassFactory = null, array $options = array())
	{
		$options['manager_class'] = $managerClass;

		parent::__construct($metadata, $registry, array('connection' => $connection), $options);
		$this->_managerClassFactory = $managerClassFactory;
	}

	/**
	 * getManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getManager()
	{
		if(!$this->_manager) {
			$this->_manager = $this->getManagerClassFactory()->createManager($this->getManagerClass(), $this->getMetadata(), $this->getConnection());
		}

		return $this->_manager;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'schema_manager';
	}
    
    /**
     * getManagerClassFactory 
     * 
     * @access public
     * @return void
     */
    public function getManagerClassFactory()
    {
        return $this->_managerClassFactory;
    }
    
    /**
     * setManagerClassFactory 
     * 
     * @param mixed $managerClassFactory 
     * @access public
     * @return void
     */
    public function setManagerClassFactory(ClassFactory $managerClassFactory)
    {
        $this->_managerClassFactory = $managerClassFactory;
        return $this;
    }
    
    /**
     * getManagerClass 
     * 
     * @access public
     * @return void
     */
    public function getManagerClass()
    {
        return $this->getOption('manager_class');
    }
    
    /**
     * setManagerClass 
     * 
     * @param mixed $managerClass 
     * @access public
     * @return void
     */
    public function setManagerClass($managerClass)
    {
        $this->setOption('manager_class', $managerClass);
        return $this;
    }
    
    /**
     * getConnection 
     * 
     * @access public
     * @return void
     */
    public function getConnection()
    {
        return $this->getService('connection');
    }
}

