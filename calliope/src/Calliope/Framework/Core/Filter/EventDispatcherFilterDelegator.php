<?php
namespace Calliope\Framework\Core\Filter;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Calliope\Framework\Core\SchemeManagerInterface;
/**
 * FilterDelegator 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class EventDispatcherFilterDelegator implements FilterDelegator 
{
	private $dispatcher;

	private $connection;

	private $events = array(
		'preCountBy'     => 'onPreCountBy',
		'postCountBy'    => 'onPostCountBy',
		'preFindBy'     => 'onPreFindBy',
		'postFindBy'    => 'onPostFindBy',
		'preFindOneBy'  => 'onPreFindOneBy',
		'postFindOneBy' => 'onPostFindOneBy',
		'preFetch'      => 'onPreFetch',
		'postFetch'     => 'onPostFetch',
		'preSave'       => 'onPreSave',
		'postSave'      => 'onPostSave',
		'preCreate'     => 'onPreCreate',
		'postCreate'    => 'onPostCreate',
		'preUpdate'     => 'onPreUpdate',
		'postUpdate'    => 'onPostUpdate',
		'preDelete'     => 'onPreDelete',
		'postDelete'    => 'onPostDelete',
		'connect'       => 'onConnect',
	);

	/**
	 * __construct 
	 * 
	 * @param SchemeManager $manager 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection = null)
	{
		$this->dispatcher = new EventDispatcher();
		$this->connection = $connection;
	}

	public function onPreFlush()
	{
		return null;
	}

	public function onPostFlush()
	{
		return null;
	}

	/**
	 * onPreFetch 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function onPreFindBy(array $criteria, array $orderBy, $limit, $offset)
	{
		$condition = new Condition\PreFetchCondition($this->getConnection(), $criteria, $orderBy, $limit, $offset);

		$this->getEventDispatcher()->dispatch('connection.preFindBy', $condition);
		$this->getEventDispatcher()->dispatch('connection.preFetch', $condition);

		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPostFindBy($result, array $criteria, array $orderBy, $limit, $offset )
	{
		$condition = new Condition\PostFetchCondition($this->getConnection(), $result, $criteria, $orderBy, $limit, $offset);

		$this->getEventDispatcher()->dispatch('connection.postFindBy', $condition);
		$this->getEventDispatcher()->dispatch('connection.postFetch', $condition);

		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPreFindOneBy(array $criteria, array $orderBy)
	{
		$condition = new Condition\PreFetchCondition($this->getConnection(), $criteria, $orderBy);

		$this->getEventDispatcher()->dispatch('connection.preFindOneBy', $condition);
		$this->getEventDispatcher()->dispatch('connection.preFetch', $condition);

		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPostFindOneBy($result, array $criteria, array $orderBy)
	{
		$condition = new Condition\PostFetchCondition($this->getConnection(), $result, $criteria, $orderBy);

		$this->getEventDispatcher()->dispatch('connection.postFindOneBy', $condition);
		$this->getEventDispatcher()->dispatch('connection.postFetch', $condition);

		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPreCountBy(array $criteria)
	{
		$condition = new Condition\PreFetchCondition($this->getConnection(), $criteria);

		$this->getEventDispatcher()->dispatch('connection.preCountBy', $condition);
		$this->getEventDispatcher()->dispatch('connection.preFetch', $condition);

		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPostCountBy($result, array $criteria)
	{
		$condition = new Condition\PostFetchCondition($this->getConnection(), $result, $criteria);

		$this->getEventDispatcher()->dispatch('connection.postCountBy', $condition);
		$this->getEventDispatcher()->dispatch('connection.postFetch', $condition);

		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPreCreate($model)
	{
		$condition = new Condition\ModelCondition($this->getConnection(), $model);
		
		$this->getEventDispatcher()->dispatch('connection.preCreate', $condition);
		$this->getEventDispatcher()->dispatch('connection.preSave', $condition);

		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPostCreate($model)
	{
		$condition = new Condition\ModelCondition($this->getConnection(), $model);
		
		$this->getEventDispatcher()->dispatch('connection.postCreate', $condition);
		$this->getEventDispatcher()->dispatch('connection.postSave', $condition);

		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPreUpdate($model)
	{
		$condition = new Condition\ModelCondition($this->getConnection(), $model);

		$this->getEventDispatcher()->dispatch('connection.preUpdate', $condition);
		$this->getEventDispatcher()->dispatch('connection.preSave', $condition);
		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPostUpdate($model)
	{
		$condition = new Condition\ModelCondition($this->getConnection(), $model);

		$this->getEventDispatcher()->dispatch('connection.postUpdate', $condition);
		$this->getEventDispatcher()->dispatch('connection.postSave', $condition);
		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPreDelete($model)
	{
		$condition = new Condition\ModelCondition($this->getConnection(), $model);
		$this->getEventDispatcher()->dispatch('connection.preDelete', $condition);
		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPostDelete($model)
	{
		$condition = new Condition\ModelCondition($this->getConnection(), $model);
		$this->getEventDispatcher()->dispatch('connection.postDelete', $condition);
		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPreReload($model)
	{
		$condition = new Condition\ModelCondition($this->getConnection(), $model);
		$this->getEventDispatcher()->dispatch('connection.preReload', $condition);
		return $condition;
	}

	/**
	 * {@inheritdoc}
	 */
	public function onPostReload($model)
	{
		$condition = new Condition\ModelCondition($this->getConnection(), $model);
		$this->getEventDispatcher()->dispatch('connection.postReload', $condition);
		return $condition;
	}

	/**
	 * onConnect 
	 * 
	 * @param mixed $connection 
	 * @access public
	 * @return void
	 */
	public function onConnect()
	{
		$condition = new Condition\ConnectCondition($this->getConnection());
		$this->getEventDispatcher()->dispatch('connection.connect', $condition);
		return $condition;
	}

	/**
	 * attachFilter 
	 * 
	 * @param mixed $filter 
	 * @access public
	 * @return void
	 */
	public function attachFilter($filter, $event = null)
	{
	
		if(null == $event) {
			foreach($this->events as $eventName => $method) {
				if(method_exists($filter, $method)) {
					$this->getEventDispatcher()->addListener('connection.' . $eventName, array($filter, $method));
				}
			}
		} else {
			if(isset($this->events[$event])) {
				$this->getEventDispatcher()->addListener('connection.' . $event, array($filter, $this->events[$event]));
			}
		}
		return $this;
	}

	/**
	 * detachFilter 
	 * 
	 * @param mixed $filter 
	 * @access public
	 * @return void
	 */
	public function detachFilter($filter, $event = null)
	{
		if(null == $event) {
			foreach($this->events as $eventName => $method) {
				if(method_exists($filter, $method)) {
					$this->getEventDispatcher()->removeListener($eventName, array($filter, $method));
				}
			}
		} else {
			if(isset($this->events[$event])) {
				$this->getEventDispatcher()->removeListener('connection.' . $event, array($filter, $this->events[$event]));
			}
		}
		return $this;
	}
    
    /**
     * Get dispatcher.
     *
     * @access public
     * @return dispatcher
     */
    public function getEventDispatcher()
    {
        return $this->dispatcher;
    }
    
    /**
     * Set dispatcher.
     *
     * @access public
     * @param dispatcher the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setEventDispatcher($dispatcher)
    {
        $this->dispatcher = $dispatcher;
        return $this;
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
    
    public function getConnection()
    {
        return $this->connection;
    }
    
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }
}

