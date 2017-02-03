<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;

/**
 * StorageAdapter 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StorageAdapter implements Storage 
{
	/**
	 * originalStorage 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $originalStorage; 

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Storage $originalStorage)
	{
		$this->originalStorage = $originalStorage;
	}

    /**
     * Get originalStorage.
     *
     * @access public
     * @return originalStorage
     */
    public function getOriginalStorage()
    {
        return $this->originalStorage;
    }

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return $this->getOriginalStorage()->count();
	}

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	public function load()
	{
		$this->getOriginalStorage()->load();
	}

	/**
	 * save 
	 * 
	 * @access public
	 * @return void
	 */
	public function save()
	{
		$this->getOriginalStorage()->save();
	}
}

