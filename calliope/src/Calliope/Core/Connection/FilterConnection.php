<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Filter,
	Calliope\Core\Filter\ConnectionFilter
;
use Calliope\Core\Connection;

use Calliope\Core\Filter\Request,
	Calliope\Core\Filter\Response
;

class FilterConnection extends ProxyConnection
{
	/**
	 * filter 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $filter;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, Filter $filter = null)
	{
		parent::__construct($connection);

		if($filter) {
			$this->filter = $filter;
		} else {
			// set ConnectionFilter 
			$this->filter = new ConnectionFilter();
		}
	}

	protected function doFilter($method, array $params = array())
	{
		$request = new Request($params);
		$response = new Response();

		// additional request Params
		$request->set('method', $method);
		$request->set('connection', $this->getConnection());

		$this->getFilter()->{'filter' . ucfirst($method)}($request, $response);

		return $response->get('response');
	}

	/**
	 * {@inheritdoc}
	 */
	public function flush()
	{
		return $this->doFilter('flush');
	}

	/**
	 * {@inheritdoc}
	 */
	public function create($model)
	{
		return $this->doFilter('create', array('data' => $model));
	}

	/**
	 * {@inheritdoc}
	 */
	public function update($model)
	{
		return $this->doFilter('update', array('data' => $model));
	}

	/**
	 * {@inheritdoc}
	 */
	public function delete($model)
	{
		return $this->doFilter('delete', array('data' => $model));
	}

	/**
	 * {@inheritdoc}
	 */
	public function reload($model)
	{
		return $this->doFilter('reload', array('data' => $model));
	}

	/**
	 * {@inheritdoc}
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		return $this->doFilter('findBy', array('criteria' => $criteria, 'orderBy' => $orderBy, 'limit' => $limit, 'offset' => $offset));
	}

	/**
	 * {@inheritdoc}
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		return $this->doFilter('findOneBy', array('criteria' => $criteria, 'orderBy' => $orderBy));
	}

	/**
	 * {@inheritdoc}
	 */
	public function countBy(array $criteria)
	{
		return $this->doFilter('countBy', array('criteria' => $criteria));
	}
    
    /**
     * getFilter
     * 
     * @access public
     * @return void
     */
    public function getFilter()
    {
        return $this->filter;
    }
    
    /**
     * setFilter
     * 
     * @param mixed $filter 
     * @access public
     * @return void
     */
    public function setFilter(FilterDelegator $filter)
    {
        $this->filter = $filter;
        return $this;
    }
}

