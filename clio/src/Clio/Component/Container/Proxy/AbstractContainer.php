<?php
namespace Clio\Component\Container\Proxy;

use Clio\Component\Container\Container;

/**
 * AbstractContainer 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractContainer
{
    /**
     * {@inheritdoc}
     */
    private $wrapped;

    /**
     * {@inheritdoc}
     */
    public function __construct(Container $container = null)
    {
        if($container) 
            $this->setWrapped($container);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->getWrapped()->clear();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->getWrapped());
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->getWrapped()->getIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function getRaw()
    {
        return $this->getWrapped()->getRaw();
    }

    /**
     * __initialize 
     * 
     * @access protected
     * @return void
     */
    protected function __initialize()
    {
        throw new \RuntimeException('Wrapped container is not initialized for proxy container.');
    }

    /**
     * getWrapped 
     * 
     * @access public
     * @return void
     */
    public function getWrapped()
    {
        if(!$this->wrapped) {
            $this->__initialize();
        }
        return $this->wrapped;
    }
    
    /**
     * setWrapped 
     * 
     * @param Container $wrapped 
     * @access public
     * @return void
     */
    public function setWrapped(Container $wrapped)
    {
        $this->wrapped = $wrapped;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(array $extra = null)
    {
        return serialize(array($this->wrapped, $extra));
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        list(
            $this->wrapped,
            $extra
        ) = unserialize($serialized);

        return $extra;
    }
}

