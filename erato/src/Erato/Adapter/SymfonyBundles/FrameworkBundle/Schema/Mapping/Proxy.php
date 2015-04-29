<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Schema\Mapping;

use Clio\Extra\Metadata\Mapping\Proxy as BaseProxy; 

use Symfony\Component\DependencyInjection\ContainerInterface;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Exception as MetadataException;

/**
 * Proxy 
 * 
 * @uses BaseMapping
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Proxy extends BaseProxy 
{
    /**
     * __container 
     * 
     * @var mixed
     * @access private
     */
    private $__container;

    /**
     * __factoryId 
     * 
     * @var mixed
     * @access private
     */
    private $__factoryId;

    /**
     * __options 
     * 
     * @var mixed
     * @access private
     */
    private $__options;

    private $__loaded = false;

    /**
     * __construct 
     * 
     * @param ContainerInterface $container 
     * @param mixed $factoryId 
     * @param Metadata $metadata 
     * @param array $options 
     * @access public
     * @return void
     */
    public function __construct(ContainerInterface $container, $factoryId, Metadata $metadata, $name, array $options = array())
    {
        parent::__construct($metadata, $name);

        $this->__container = $container;
        $this->__factoryId = $factoryId;
        $this->__options   = $options;
    }

    /**
     * __initialize 
     * 
     * @access protected
     * @return void
     */
    protected function __initialize()
    {
        try {
            $this->__setWrapped(
                $this->__container->get($this->__factoryId)
                    ->createMapping(
                        $this->getMetadata(),
                        $this->__options
                    )
                );
            $this->__loaded = true;
        } catch(\Exception $ex) {
            // Failed to create Mapping, cause it is not supported.
            throw new MetadataException\UnsupportedException(sprintf('Unsupported Mapping "%s" for Schema "%s"', $this->getName(), $this->getMetadata()->getName()));
        }
    }

    public function getOptions() 
    {
        if($this->__isLoaded()) {
            return $this->__getWrapped()->getOptions();
        } else {
            return $this->__options;
        }
    }

    public function setOptions(array $options) 
    {
        if($this->__isLoaded()) {
            $this->__getWrapped()->setOptions($options);
        } else {
            $this->__options = $options;
        }
    }

    public function __isLoaded()
    {
        return $this->__loaded;
    }
}

