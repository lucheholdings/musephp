<?php
namespace Clio\Component\Util\Hash\Resolver;

use Clio\Component\Util\Hash\Strategy\HashGenerateStrategyInterface;

/**
 * StrategyHashResovler 
 * 
 * @uses HsahResovlerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StrategyHashResovler implements HashResovlerInterface
{
	/**
	 * strategy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $strategy;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(HashGenerateStrategyInterface $strategy)
	{
		$this->strategy = $strategy;
	}

	/**
	 * resolve 
	 * 
	 * @access public
	 * @return void
	 */
	public function resolve()
	{
		return call_user_func_array(
			array($this->getStrategy(), 'generate'),
			func_get_args()
		);
	}
    
    /**
     * Get strategy.
     *
     * @access public
     * @return strategy
     */
    public function getStrategy()
    {
        return $this->strategy;
    }
    
    /**
     * Set strategy.
     *
     * @access public
     * @param strategy the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;
        return $this;
    }
}

