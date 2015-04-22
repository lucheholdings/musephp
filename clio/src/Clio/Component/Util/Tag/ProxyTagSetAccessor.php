<?php
namespace Clio\Component\Util\Tag;

/**
 * ProxyTagSetAccessor 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyTagSetAccessor implements TagSetAccessorInterface
{
    private $sourceAccessor;

	public function __construct(TagSetAccessorInterface $accessor) 
    {
        $this->sourceAccessor = $accessor;    
    }

	/**
	 * createTag 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function createTag($name)
	{
		return $this->getSourceAccessor()->createTag($name);
	}

    /**
     * add 
     * 
     * @param TagSet $container 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function add(TagSet $container, $name)
	{
        return $this->sourceAccessor->add($container, $name);
	}

    /**
     * has 
     * 
     * @param TagSet $container 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function has(TagSet $container, $name)
	{
		return $this->sourceAccessor->has($container, $name);
	}
	
    /**
     * remove 
     * 
     * @param TagSet $container 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function remove(TagSet $container, $name)
	{
        return $this->sourceAccessor->remove($container, $naem);
	}

    /**
     * removeAll 
     * 
     * @param TagSet $container 
     * @access public
     * @return void
     */
	public function removeAll(TagSet $container)
	{
        return $this->sourceAccessor->removeAll($container);
	}

    /**
     * replace 
     * 
     * @param TagSet $container 
     * @param array $names 
     * @access public
     * @return void
     */
	public function replace(TagSet $container, array $names)
	{
        return $this->sourceAccessor->replace($container, $names);
	}

    /**
     * getNames 
     * 
     * @param TagSet $container 
     * @access public
     * @return void
     */
	public function getNames(TagSet $container)
	{
        return $this->sourceAccessor->getNames($container);
	}
}

