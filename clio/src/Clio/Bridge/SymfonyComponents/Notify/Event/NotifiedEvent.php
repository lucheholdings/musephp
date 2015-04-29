<?php
namespace Clio\Bridge\SymfonyComponents\Notify\Event;

use Symfony\Component\EventDispatcher\Event;
use Clio\Component\Notify\Notifier;

/**
 * NotifiedEvent 
 * 
 * @uses Event
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NotifiedEvent extends Event 
{
	/**
	 * notifier 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $notifier;

	/**
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

	/**
	 * response 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $response;

	/**
	 * __construct 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(Notifier $notifier, array $options = array())
	{
		$this->notifier = $notifier;
		$this->options = $options;
		$this->response = null;
	}
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * setOptions 
     * 
     * @param mixed $options 
     * @access public
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

	/**
	 * hasOption 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasOption($key)
	{
		return isset($this->options[$key]);
	}

	/**
	 * getOption
	 * 
	 * @param mixed $key 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	public function getOption($key, $default = null)
	{
		return isset($this->options[$key]) 
			? $this->options[$key]
			: $default;
	}
    
	/**
	 * setOption 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setOption($key, $value)
	{
		$this->options[$key] = $value;
	}

    /**
     * getResponse 
     * 
     * @access public
     * @return void
     */
    public function getResponse()
    {
        return $this->response;
    }
    
    /**
     * setResponse 
     * 
     * @param mixed $response 
     * @access public
     * @return void
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }
    
    public function getNotifier()
    {
        return $this->notifier;
    }
    
    public function setNotifier($notifier)
    {
        $this->notifier = $notifier;
        return $this;
    }
}

