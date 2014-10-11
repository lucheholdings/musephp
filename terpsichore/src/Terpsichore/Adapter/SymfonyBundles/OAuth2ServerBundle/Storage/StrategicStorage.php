<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\StorageStrategy;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Util\StorageUtil;

/**
 * StrategicStorage 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class StrategicStorage extends AbstractStorage
{
	/**
	 * {@inheritdoc}
	 */
	private $strategy;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(StorageStrategy $strategy, StorageUtil $storageUtil = null)
	{
		$this->strategy = $strategy;

		parent::__construct($storageUtil);
	}
    
    /**
     * {@inheritdoc}
     */
    public function getStrategy()
    {
        return $this->strategy;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setStrategy(StorageStrategy $strategy)
    {
        $this->strategy = $strategy;
        return $this;
    }
}

