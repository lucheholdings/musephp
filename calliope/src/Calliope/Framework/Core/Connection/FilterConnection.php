<?php
namespace Calliope\Framework\Core\Connection;

use Calliope\Framework\Core\Filter\FilterDelegator;
use Calliope\Framework\Core\Connection;

class FilterConnection extends ProxyConnection
{
	/**
	 * filters 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $filters;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, FilterDelegator $filters)
	{
		parent::__construct($connection);

		$this->filters = $filters;
		$this->filters->setConnection($connection);
	}

	public function flush()
	{
		$this->filters->onPreFlush();

		$result = parent::flush();

		$this->filters->onPostFlush($result);

		return $result;
	}

	public function create($model)
	{
		$cond = $this->filters->onPreCreate($model);

		$result = parent::create($cond->getModel());
		$cond = $this->filters->onPostCreate($result);
		return $cond->getModel();
	}

	public function update($model)
	{
		$cond = $this->filters->onPreUpdate($model);

		$result = parent::update($cond->getModel());

		$cond = $this->filters->onPostUpdate($result);

		return $cond->getModel();
	}

	public function delete($model)
	{
		$cond = $this->filters->onPreDelete($model);

		$result = parent::delete($cond->getModel());

		$cond = $this->filters->onPostDelete($result);
		return $cond->getModel();
	}

	public function reload($model)
	{
		$cond = $this->filters->onPreReload($model);

		$result = parent::reload($cond->getModel());

		$cond = $this->filters->onPostReload($result);
		return $cond->getModel();
	}

	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$cond = $this->filters->onPreFindBy($criteria, $orderBy, $limit, $offset);
		$criteria = $cond->getCriteria();
		$orderBy = $cond->getOrderBy();
		$limit = $cond->getLimit();
		$offset = $cond->getOffset();

		$result = parent::findBy($criteria, $orderBy, $limit, $offset);

		$cond = $this->filters->onPostFindBy($result, $criteria, $orderBy, $limit, $offset);

		return $cond->getResult();
	}

	public function findOneBy(array $criteria, array $orderBy = array())
	{
		$cond = $this->filters->onPreFindOneBy($criteria, $orderBy);
		$criteria = $cond->getCriteria();
		$orderBy = $cond->getOrderBy();

		$result = parent::findOneBy($criteria, $orderBy);

		$cond = $this->filters->onPostFindOneBy($result, $criteria, $orderBy);
		return $cond->getResult();
	}

	public function countBy(array $criteria)
	{
		$cond = $this->filters->onPreCountBy($criteria);
		$criteria = $cond->getCriteria();

		$result = parent::countBy($criteria);

		$cond = $this->filters->onPostCountBy($result, $criteria);

		return $cond->getResult();
	}

	public function setConnectFrom($connect)
	{
		parent::setConnectFrom($connect);

		$this->filters->onConnect();
	}
    
    public function getFilters()
    {
        return $this->filters;
    }
    
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }
}

