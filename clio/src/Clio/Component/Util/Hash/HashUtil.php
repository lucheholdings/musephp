<?php
namespace Clio\Component\Util\Hash;

use Clio\Component\Util\Hash\Strategy\PseudoHashGenerateStrategy;

/**
 * HashUtil 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HashUtil 
{
	/**
	 * _instance 
	 * 
	 * @var mixed
	 * @access protected
	 */
	static protected $_instance;

	/**
	 * getInstance 
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function getInstance()
	{
		if(!static::$_instance) {
			// Create instance with default strategy
			static::$_instance = new static();
		}
		return static::$_instance;
	}

	/**
	 * generate 
	 *   Generate Hash 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function generateHash()
	{
		return self::getInstance()->generate(func_get_args());
	}

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
	 * @param HashGenerateStrategyInterface $strategy 
	 * @access public
	 * @return void
	 */
	public function __construct(HashGenerateStrategyInterface $strategy = null)
	{
		if($strategy) {
			$this->strategy = $strategy;
		} else {
			// Set default strategy
			$this->strategy = new PseudoHashGenerateStrategy();
		}
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
    public function setStrategy(HashGenerateStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
        return $this;
    }

	/**
	 * generateHash 
	 * 
	 * @access public
	 * @return void
	 */
	public function generate(array $args = array())
	{
		return call_user_func_array(array($this->strategy, 'generate'), $args);
	}
}

