<?php
namespace Clio\Component\Pattern\Registry;

class ProxyRegistry implements Registry
{
	/**
	 * registry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $registry;

	/**
	 * __construct 
	 * 
	 * @param Registry $registry 
	 * @access public
	 * @return void
	 */
	public function __construct(Registry $registry)
	{
		$this->registry = $registry;
	}

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return $this->registry->has($key);
    }

	/**
	 * {@inheritdoc}
	 */
	public function get($key)
	{
		return $this->registry->get($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($key, $entry) 
	{
		$this->registry->set($key, $entry);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($key)
	{
		return $this->registry->remove($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear()
    {
        return $this->registry->clear();
    }

	/**
	 * {@inheritdoc}
	 */
	public function count()
    {
        return $this->registry->count();
    }
    
    /**
     * getRegistry 
     * 
     * @access public
     * @return void
     */
    public function getRegistry()
    {
        return $this->registry;
    }
    
    /**
     * setRegistry 
     * 
     * @param mixed $registry 
     * @access public
     * @return void
     */
    public function setRegistry($registry)
    {
        $this->registry = $registry;
        return $this;
    }
}

