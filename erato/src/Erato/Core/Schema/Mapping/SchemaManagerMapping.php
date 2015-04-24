<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
use Erato\Core\Manager\SchemaManager;
use Erato\Core\Manager\Factory\SchemaManagerClassFactory;

/**
 * SchemaManagerMapping 
 *    
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaManagerMapping extends AbstractMapping 
{
	/**
	 * _managerClassFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_managerClassFactory;

	/**
	 * __construct 
	 * 
	 * @param Metadata $metadata 
	 * @param Factory $managerClassFactory 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, $managerClass, SchemaManagerClassFactory $managerClassFactory = null, array $options = array())
	{
		$options['manager_class'] = $managerClass;
		parent::__construct($metadata, $options);
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
		if($this->_manager) {
			$this->_manager = $this->getManagerClassFactory()->createSchemaManagerWithClass($this->getManagerClass());
		}
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
        return $this->managerClassFactory;
    }
    
    /**
     * setManagerClassFactory 
     * 
     * @param mixed $managerClassFactory 
     * @access public
     * @return void
     */
    public function setManagerClassFactory(SchemaManagerClassFactory $managerClassFactory)
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
}

