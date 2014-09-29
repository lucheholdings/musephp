<?php
namespace Clio\Bridge\Doctrine\Container;

use Clio\Component\Util\Container\Set;

/**
 * ProxySet 
 * 
 * @uses ProxyCollection
 * @uses Set
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ProxySet extends AbstractProxyContainer implements Set 
{
    /**
     * toArray 
     * 
     * @access public
     * @return void
     */
    public function toArray()
    {
        return $this->getDoctrineCollection()->toArray();
    }

    /**
     * clear 
     * 
     * @access public
     * @return void
     */
    public function clear()
    {
        return $this->getDoctrineCollection()->clear();
    }

    /**
     * add
     * 
     * @param mixed $vlaue 
     * @access public
     * @return void
     */
    public function add($value)
    {
        return $this->getDoctrineCollection()->add($value);
    }

    /**
     * has
     * 
     * @param mixed $value
     * @access public
     * @return void
     */
    public function has($value)
    {
        return $this->getDoctrineCollection()->contains($value);
    }

    /**
     * remove
     * 
     * @param mixed $value
     * @access public
     * @return void
     */
    public function remove($value)
    {
        return $this->getDoctrineCollection()->removeElement($value);
    }

    /**
     * getValues 
     * 
     * @access public
     * @return void
     */
    public function getValues()
    {
        return $this->getDoctrineCollection()->map(function($element) {	
			return $element->getValue();
		});
    }
}
