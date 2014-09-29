<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Connection;

use Symfony\Component\EventDispatcher\EventDispatcher;

class EventDispatcherConnection extends ProxyConnection 
{
	/**
	 * eventDispatcher 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $eventDispatcher;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection)
	{
		parent::__construct($connection);

		$this->eventDispatcher = new EventDispatcher();
	}
    
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }
    
    public function setEventDispatcher($eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        return $this;
    }

	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$event = new Conditions\PreFetchCondition($this->getConnection(), $model);
		$this->getEventDispatcher()->dispatch('preFetch', $event);
		
		$result = $this->getConnection()->findBy($event->getCriteria(), $event->getOrderBy(), $event->getLimit(), $event->getOffset());

		if($result) {
			$event = new Conditions\PostFetchCondition($this->getConnection(), null, $criteria, $orderBy, $limit, $offset);
			if($result instanceof LazyLoadCollection) {
				
				// Set post fetch handler as PostLoadCallback
				$result->setPostLoadCallback(function($loaded) use ($eventDispatcher, $event) {
					// Set Loaded Data as Result
					$event->setResult($loaded);
					$eventDispatcher->dispatch('postFetch', $event);
					return $event->getResult();
				});
			} else {
				$event->setResult($result);
				$this->getEventDispatcher()->dispatch('postFetch', $event);

				$result = $event->getResult();
			}
		}

		return $result;
	}

	public function findOneBy(array $criteria, array $orderBy = array())
	{
		$event = new Conditions\PreFetchCondition($this->getConnection(), $criteria, $orderBy);
		$this->getEventDispatcher()->dispatch('preFetch', $event);
		
		$result = $this->getConnection()->findOneBy($event->getCriteria(), $event->getOrderBy());

		$event = new Conditions\PostFetchCondition($this->getConnection(), $result, $criteria, $orderBy);
		$this->getEventDispatcher()->dispatch('postFetch', $event);

		return $event->getResult();
	}

	public function create($model)
	{
		$event = new Conditions\ModelPreCondition($this->getConnection(), $model);
		$this->getEventDispatcher()->dispatch('preCreate', $event);
		
		$model = $this->getConnection()->create($event->getModel());

		$event = new Conditions\ModelPostCondition($this->getConnection(), $model);
		$this->getEventDispatcher()->dispatch('postCreate', $event);

		return $event->getModel();
	}
}

