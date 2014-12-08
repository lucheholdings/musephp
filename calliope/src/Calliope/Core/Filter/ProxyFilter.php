<?php
namespace Calliope\Core\Filter;

/**
 * ProxyFilter 
 * 
 * @uses Filter
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class ProxyFilter implements Filter
{
	/**
	 * filter 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $filter;

	/**
	 * __construct 
	 * 
	 * @param Filter $filter 
	 * @access public
	 * @return void
	 */
	public function __construct(Filter $filter)
	{
		$this->filter = $filter;
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
     * @param Filter $filter 
     * @access public
     * @return void
     */
    public function setFilter(Filter $filter)
    {
        $this->filter = $filter;
        return $this;
    }
}

