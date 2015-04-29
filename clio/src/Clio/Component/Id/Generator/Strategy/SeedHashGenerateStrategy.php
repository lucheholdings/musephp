<?php
namespace Clio\Component\Id\Generator\Strategy;

use Clio\Component\Id\Generator\Strategy;

/**
 * SeedHashGenerateStrategy 
 * 
 * @uses HashGenerateStrategyInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SeedHashGenerateStrategy implements Strategy
{
	/**
	 * algorithm 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $algorithm;

	/**
	 * __construct 
	 * 
	 * @param string $algorithm 
	 * @access public
	 * @return void
	 */
	public function __construct($algorithm = 'sha1')
	{
		$this->algorithm = $algorithm;
	}

	/**
	 * generate 
	 * 
	 * @param mixed $seed 
	 * @access public
	 * @return void
	 */
	public function generate($seed = null)
	{
		if(!$seed) {
			throw new \Clio\Component\Exception\InvalidArgumentException('SeedHashGenerateStrategy requires $seed to generate hash value.');
		}
		$bytes = hash($this->algorithm, $seed, true);

		return base_convert(bin2hex($bytes), 16, 32);
	}
    
    /**
     * Get algorithm.
     *
     * @access public
     * @return algorithm
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }
    
    /**
     * Set algorithm.
     *
     * @access public
     * @param algorithm the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAlgorithm($algorithm)
    {
        $this->algorithm = $algorithm;
        return $this;
    }
}

