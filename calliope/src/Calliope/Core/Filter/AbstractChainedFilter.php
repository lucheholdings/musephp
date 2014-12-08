<?php
namespace Calliope\Core\Filter;

use Calliope\Core\Filter;

/**
 * AbstractChainedFilter 
 * 
 * @uses Filter
 * @uses ChainedFilter
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractChainedFilter implements Filter, ChainedFilter
{
	/**
	 * chain 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $chain;

	/**
	 * __construct 
	 * 
	 * @param Filter $chain 
	 * @access public
	 * @return void
	 */
	public function __construct(Filter $chain = null)
	{
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
    public function setChain(Filter $chain)
    {
        $this->chain = $chain;
        return $this;
    }
}

