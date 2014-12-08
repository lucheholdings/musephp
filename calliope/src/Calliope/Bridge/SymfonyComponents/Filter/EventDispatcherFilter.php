<?php
namespace Calliope\Bridge\SymfonyComponents\Filter;

use Symfony\Component\EventDispatcher\EventDispatcherInterface,
	Symfony\Component\EventDispatcher\EventDispatcher;
use Calliope\Core\Filter,
	Calliope\Core\Filter\AbstractChainedFilter;
use Calliope\Core\Filter\Request,
	Calliope\Core\Filter\Response
;
use Calliope\Bridge\SymfonyComponents\Filter\Event\FilterEvent;

/**
 * EventDispatcherFilter
 * 
 * @uses FilterDelegator
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class EventDispatcherFilter extends AbstractChainedFilter 
{
	const NAMESPACE_GLUE = '.';

	private $delegatee;

	private $dispatcher;

	private $namespace; 

	public function __construct(Filter $chain = null, EventDispatcherInterface $dispatcher = null)
	{
		parent::__construct($chain);

		if(!$dispatcher) 
			$dispatcher = new EventDispatcher();
		
		$this->dispatcher = $dispatcher;
	}
    
	/**
	 * filterFetch 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function filterFindBy(Request $request, Response $response)
	{
		$event = new FilterEvent($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preFindBy'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preFetch'), $event);

		$this->getChain()->filterFindBy($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postFetch'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postFindBy'), $event);

		return $response;
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterFindOneBy(Request $request, Response $response)
	{
		$event = new FilterEvent($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preFindOneBy'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preFetch'), $event);

		$this->getChain()->filterFindOneBy($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postFetch'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postFindOneBy'), $event);

		return $response;
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterCountBy(Request $request, Response $response)
	{
		$event = new FilterEvent($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preCountBy'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preFetch'), $event);

		$this->getChain()->filterCountBy($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postFetch'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postCountBy'), $event);


		return $response;
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterCreate(Request $request, Response $response)
	{
		$event = new FilterEvent($request, $response);
		
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preCreate'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preSave'), $event);

		$this->getChain()->filterCreate($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postSave'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postCreate'), $event);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterUpdate(Request $request, Response $response)
	{
		$event = new FilterEvent($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preUpdate'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preSave'), $event);

		$this->getChain()->filterUpdate($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postSave'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postUpdate'), $event);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterDelete(Request $request, Response $response)
	{
		$event = new FilterEvent($request, $response);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preDelete'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preSave'), $event);

		$this->getChain()->filterDelete($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postSave'), $event);
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postDelete'), $event);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterReload(Request $request, Response $response)
	{
		$event = new FilterEvent($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preReload'), $event);

		$this->getChain()->filterReload($request, $response);
		
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postReload'), $event);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterFlush(Request $request, Response $response)
	{
		$event = new FilterEvent($request, $response);

		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('preFlush'), $event);

		$this->getChain()->filterFlush($request, $response);
		
		$this->getEventDispatcher()->dispatch($this->getNamespacedEventName('postFlush'), $event);
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
    public function setEventDispatcher(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        return $this;
    }

	/**
	 * getNamespacedEventName 
	 * 
	 * @param mixed $eventName 
	 * @access public
	 * @return void
	 */
	public function getNamespacedEventName($eventName)
	{
		if($this->namespace) {
			$eventName = $this->namespace . self::NAMESPACE_GLUE . $eventName;
		}

		return $eventName;
	}
    
    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setNamespace($namespace)
    {
        $this->namespace = rtrim($namespace, self::NAMESPACE_GLUE);
        return $this;
    }
}

