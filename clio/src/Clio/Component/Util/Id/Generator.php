<?php
namespace Clio\Component\Util\Id;

use Clio\Component\Util\Id\Generator\Strategy;

/**
 * Generator 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Generator 
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
	 * generateDefault 
	 *   Generate with default strategy
	 * @static
	 * @access public
	 * @return void
	 */
	static public function generateDefault()
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
	 * @param Strategy $strategy 
	 * @access public
	 * @return void
	 */
	public function __construct(Strategy $strategy = null)
	{
		if($strategy) {
			$this->strategy = $strategy;
		} else {
			// Set default strategy
			$this->strategy = new Strategy\PseudoHashGenerateStrategy();
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
    public function setStrategy(Strategy $strategy)
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

