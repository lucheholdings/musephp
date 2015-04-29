<?php
namespace Calliope\Extra\Filter\ListenerFactory;

use Calliope\Bridge\SymfonyComponents\Filter\ListenerFactory;
use Clio\Component\Cache\CacheProvider;

/**
 * CacheFactory 
 * 
 * @uses BaseFactory
 * @uses ListenerFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CacheListenerFactory extends BaseFactory implements ListenerFactory 
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		parent::__construct(new \ReflectionClass('Calliope\Extra\Filter\Listener\CacheListener'));

		$this->options = new Collection($options);
	}

	/**
	 * createFilterListener 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createFilterListener(array $options = array())
	{
		$options = $this->getOptions()->merge($options);

		$listener = new CacheListener($options->get('cache'));

		// create Component with cache
		return parent::crateComponentArgs(array($options->get('cache')));
	}
}
