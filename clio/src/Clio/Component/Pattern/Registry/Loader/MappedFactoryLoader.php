<?php
namespace Clio\Component\Pattern\Registry\Loader;

use Clio\Component\Pattern\Factory\MappedFactory;

/**
 * MappedFactoryLoader 
 * 
 * @uses AbsrtactLoader
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MappedFactoryLoader extends AbstractLoader 
{
	/**
	 * factory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $factory;

	/**
	 * __construct 
	 * 
	 * @param MappedFactory $factory 
	 * @access public
	 * @return void
	 */
	public function __construct(MappedFactory $factory)
	{
		$this->factory = $factory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadEntry($key)
	{
		return $this->factory->createByKey($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canLoad($key)
	{
		return $this->factory->isSupportedKeyArgs($key);
	}
    
    /**
     * getFactory 
     * 
     * @access public
     * @return void
     */
    public function getFactory()
    {
        return $this->factory;
    }
    
    /**
     * setFactory 
     * 
     * @param MappedFactory $factory 
     * @access public
     * @return void
     */
    public function setFactory(MappedFactory $factory)
    {
        $this->factory = $factory;
        return $this;
    }
}

