<?php
namespace Calliope\Bridge\SymfonyComponents\Filter;

use Symfony\Component\EventDispatcher\EventDispatcher;

class FilterEventDispatcher extends EventDispatcher
{
	private $events = array(
		'preCountBy'     => 'onPreCountBy',
		'postCountBy'    => 'onPostCountBy',
		'preFindBy'      => 'onPreFindBy',
		'postFindBy'     => 'onPostFindBy',
		'preFindOneBy'   => 'onPreFindOneBy',
		'postFindOneBy'  => 'onPostFindOneBy',
		'preFetch'       => 'onPreFetch',
		'postFetch'      => 'onPostFetch',
		'preSave'        => 'onPreSave',
		'postSave'       => 'onPostSave',
		'preCreate'      => 'onPreCreate',
		'postCreate'     => 'onPostCreate',
		'preUpdate'      => 'onPreUpdate',
		'postUpdate'     => 'onPostUpdate',
		'preDelete'      => 'onPreDelete',
		'postDelete'     => 'onPostDelete',
		'connect'        => 'onConnect',
	);

	public function addFilterListener($listener, $priority = 0, $event = null)
	{
		if($event) {
			$this->addListener($event, array($listener, $method), $priority);
		} else {
			foreach($this->events as $event => $method) {
				if(method_exists($listener, $method)) {
					$this->addListener($event, array($listener, $method), $priority);
				}
			}
		}
	}

	/**
	 * setDefaultEventHandler 
	 * 
	 * @param mixed $event 
	 * @param mixed $method 
	 * @access public
	 * @return void
	 */
	public function setDefaultEventHandler($event, $method)
	{
		$this->events[$event] = $method;
	}
}

