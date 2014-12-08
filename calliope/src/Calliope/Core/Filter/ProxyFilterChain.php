<?php
namespace Calliope\Core\Filter;

/**
 * ProxyFilterChain 
 * 
 * @uses ProxyFilter
 * @uses ChainedFilter
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyFilterChain extends ProxyFilter implements ChainedFilter
{
	protected $chain;

	public function __construct(Filter $filter, Filter $chain = null)
	{
		parent::__construct($filter);
		$this->chain = $chain;
	}
    
    /**
     * getChain 
     * 
     * @access public
     * @return void
     */
    public function getChain()
    {
        return $this->chain;
    }
    
    /**
     * setChain 
     * 
     * @param mixed $chain 
     * @access public
     * @return void
     */
    public function setChain($chain)
    {
        $this->chain = $chain;
        return $this;
    }
}

