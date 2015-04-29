<?php
namespace Calliope\Core\Schema\Mapping;

use Calliope\Core\Schema\Manager;
use Clio\Component\Metadata;

/**
 * ManagerMapping 
 * 
 * @uses Metadata
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ManagerMapping extends Metadata\Mapping\AbstractMapping;
{
    const OPTION_MANAGER_CLASS    = 'manager_class';

    /**
     * managerFactory 
     * 
     * @var mixed
     * @access private
     */
    private $managerFactory;

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
     * @param Metadata\Metadata $metadata 
     * @param mixed $managerFactory 
     * @param array $options 
     * @access public
     * @return void
     */
    public function __construct(Metadata\Metadata $metadata, Manager\Factory\ClassFactory $managerFactory, array $options = array())
    {
        parent::__construct($metadata, $options);

        $this->managerFactory = $managerFactory;
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
            // create manager
            $this->_manager = $this->managerFactory->createManager($this->getManagerClass(), $this->getMetadata(), $this->getConnection(), $this->getManagerOptions());
        }

        return $this->_manager;
    }

    /**
     * getManagerClass 
     * 
     * @access public
     * @return void
     */
    public function getManagerClass()
    {
        return $this->getOption(self::OPTION_MANAGER_CLASS);
    }

    /**
     * getConnection 
     * 
     * @access public
     * @return void
     */
    public function getConnection()
    {
        return $this->getMetadata()->getMapping('connection')->getConnection());
    }

    /**
     * getManagerOptions 
     * 
     * @access public
     * @return void
     */
    public function getManagerOptions()
    {
        return array();
    }
}

