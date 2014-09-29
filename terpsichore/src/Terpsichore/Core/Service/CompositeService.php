<?php
namespace Terpsichore\Core\Service;

use Terpsichore\Core\Service;

/**
 * CompositeService 
 * 
 * @uses AbstractService
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CompositeService extends AbstractService 
{
	/**
	 * {@inheritdoc}
	 */
	private $services;

    /**
     * {@inheritdoc}
     */
    public function getServices()
    {
        return $this->services;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setServices($services)
    {
        $this->services = $services;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function hasService($alias)
	{
		return isset($this->services[$alias]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getService($alias)
	{
		if(!isset($this->services[$alias])) {
			throw new \InvalidArgumentException(sprintf(
				'SubService "%s" is not exists on Service "%s"',
				$alias,
				$this->getName()
			));
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function setService($alias, Service $service)
	{
		$this->services[$alias] = $service;

		// Set Client setting.
		$service->setClient($this->getClient());

		return $this;
	}
}

