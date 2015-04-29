<?php
namespace Calliope\Core\Schema\Mapping\Factory;

use Calliope\Core\Schema\Mapping\ManagerMapping;
use Calliope\Core\Schema\Manager;
use Clio\Component\Metadata;

/**
 * ManagerMappingFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ManagerMappingFactory extends Metadata\Mapping\Factory\AbstractFactory
{
    /**
     * managerFactory 
     * 
     * @var mixed
     * @access private
     */
    private $managerFactory;

    /**
     * __construct 
     * 
     * @param Manager\Factory\ClassFactory $managerFactory 
     * @access public
     * @return void
     */
    public function __construct(Manager\Factory\ClassFactory $managerFactory)
    {
        parent::__construct(array(
                ManagerMapping::OPTION_MANAGER_CLASS => 'Calliope\Core\Schema\Manager\BasicManager',
            ));
        $this->managreFactory = $managerFactory;
    }

    /**
     * doCreateMapping 
     * 
     * @param Metadata\Metadata $metadata 
     * @param array $options 
     * @access protected
     * @return void
     */
    protected function doCreateMapping(Metadata\Metadata $metadata, array $options) 
    {
		if(($metadata instanceof Metadata\Schema) && $metadata->hasMapping('connection')) {
            $mapping = new ManagerMapping($metadata, $this->managerFactory, $options);
        } else {
            throw new Metadata\Exception\UnsupportedException('ManagerMapping only support with Schema which has "connection" mapping.');
        }

        return $mapping;
    }
    
    /**
     * getManagerFactory 
     * 
     * @access public
     * @return void
     */
    public function getManagerFactory()
    {
        return $this->managerFactory;
    }
    
    /**
     * setManagerFactory 
     * 
     * @param Manager\Factory\ClassFactory $managerFactory 
     * @access public
     * @return void
     */
    public function setManagerFactory(Manager\Factory\ClassFactory $managerFactory)
    {
        $this->managerFactory = $managerFactory;
        return $this;
    }
}

