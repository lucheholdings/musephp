<?php
namespace Clio\Component\Util\Container;

use Clio\Component\Util\Container\Storage;
/**
 * StoragedContainer 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class StoragedContainer implements Container
{
	/**
	 * createForStorage 
	 * 
	 * @param Storage $storage 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createForStorage(Storage $storage)
	{
		return new static($storage);
	}

	/**
	 * storage 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $storage;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Storage $storage)
	{
		$this->storage = $storage;

		$this->initContainer();
	}

	/**
	 * getRaw 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRaw()
	{
		return $this->getStorage()->getRaw();
	}
    
	/**
	 * initContainer 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initContainer()
	{
		/* Initialize class definition and more */
	}

    /**
     * Get storage.
     *
     * @access public
     * @return storage
     */
    public function getStorage()
    {
        return $this->storage;
    }
    
    /**
     * Set storage.
     *
     * @access public
     * @param storage the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setStorage($storage)
    {
        $this->storage = $storage;
        return $this;
    }

	public function serialize()
	{
		return serialize($this->getStorate());
	}

	public function unserialize($serialized)
	{
		$this->setStorateg(unserialize($serialized));
	}
}

