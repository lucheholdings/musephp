<?php
namespace Terpsichore\Client\Handler;

use Terpsichore\Client\Service;

/**
 * AbstarctHandler 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractHandler 
{
	private $service;

	private $params;

	public function __construct(Service $service, array $params = array())
	{
		$this->service = $service;
		$this->params = $params;
	}

	abstract public function handle($request);
    
    public function getParameters()
    {
        return $this->params;
    }
    
    public function setParameters(array $params)
    {
        $this->params = $params;
        return $this;
    }

	public function hasParameter($key)
	{
		return array_key_exists($key, $this->params);
	}

	public function getParameter($key)
	{
		return isset($this->params[$key]) ? $this->params[$key] : null;
	}
    
    public function getService()
    {
        return $this->service;
    }
    
    public function setService(Service $service)
    {
        $this->service = $service;
        return $this;
    }
}

