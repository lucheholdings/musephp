<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Filter\FilterDelegator;
use Calliope\Core\Connection;

class FilterConnection extends ProxyConnection
{
	/**
	 * filterDelegator 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $filterDelegator;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, FilterDelegator $filterDelegator)
	{
		parent::__construct($connection);

		$this->filterDelegator = $filterDelegator;
		$this->filterDelegator->setConnection($connection);
	}

	/**
	 * {@inheritdoc}
	 */
	public function flush()
	{
		$this->filterDelegator->onPreFlush();

		$result = parent::flush();

		$this->filterDelegator->onPostFlush($result);

		return $result;
	}

	/**
	 * {@inheritdoc}
	 */
	public function create($model)
	{
		$cond = $this->filterDelegator->onPreCreate($model);

		$result = parent::create($cond->getModel());

		$cond = $this->filterDelegator->onPostCreate($result);
		return $cond->getModel();
	}

	/**
	 * {@inheritdoc}
	 */
	public function update($model)
	{
		$cond = $this->filterDelegator->onPreUpdate($model);

		$result = parent::update($cond->getModel());

		$cond = $this->filterDelegator->onPostUpdate($result);

		return $cond->getModel();
	}

	/**
	 * {@inheritdoc}
	 */
	public function delete($model)
	{
		$cond = $this->filterDelegator->onPreDelete($model);

		$result = parent::delete($cond->getModel());

		$cond = $this->filterDelegator->onPostDelete($result);
		return $cond->getModel();
	}

	/**
	 * {@inheritdoc}
	 */
	public function reload($model)
	{
		$cond = $this->filterDelegator->onPreReload($model);

		$result = parent::reload($cond->getModel());

		$cond = $this->filterDelegator->onPostReload($result);
		return $cond->getModel();
	}

	/**
	 * {@inheritdoc}
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$cond = $this->filterDelegator->onPreFindBy($criteria, $orderBy, $limit, $offset);
		$criteria = $cond->getCriteria();
		$orderBy = $cond->getOrderBy();
		$limit = $cond->getLimit();
		$offset = $cond->getOffset();

		$result = parent::findBy($criteria, $orderBy, $limit, $offset);

		$cond = $this->filterDelegator->onPostFindBy($result, $criteria, $orderBy, $limit, $offset);

		return $cond->getResult();
	}

	/**
	 * {@inheritdoc}
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		$cond = $this->filterDelegator->onPreFindOneBy($criteria, $orderBy);
		$criteria = $cond->getCriteria();
		$orderBy = $cond->getOrderBy();

		$result = parent::findOneBy($criteria, $orderBy);

		$cond = $this->filterDelegator->onPostFindOneBy($result, $criteria, $orderBy);
		return $cond->getResult();
	}

	/**
	 * {@inheritdoc}
	 */
	public function countBy(array $criteria)
	{
		$cond = $this->filterDelegator->onPreCountBy($criteria);
		$criteria = $cond->getCriteria();

		$result = parent::countBy($criteria);

		$cond = $this->filterDelegator->onPostCountBy($result, $criteria);

		return $cond->getResult();
	}

	/**
	 * {@inheritdoc}
	 */
	public function setConnectFrom($connect)
	{
		parent::setConnectFrom($connect);

		$this->filterDelegator->onConnect();
	}
    
    /**
     * getFilterDelegator 
     * 
     * @access public
     * @return void
     */
    public function getFilterDelegator()
    {
        return $this->filterDelegator;
    }
    
    /**
     * setFilterDelegator 
     * 
     * @param mixed $filterDelegator 
     * @access public
     * @return void
     */
    public function setFilterDelegator($filterDelegator)
    {
        $this->filterDelegator = $filterDelegator;
        return $this;
    }
}

