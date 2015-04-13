<?php
namespace Clio\Component\Pattern\Constructor;

/**
 * CopyConstructor 
 * 
 * @uses Constructor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CopyConstructor implements Constructor
{
    /**
     * base 
     * 
     * @var mixed
     * @access private
     */
    private $base;

    /**
     * __construct 
     * 
     * @param mixed $base 
     * @access public
     * @return void
     */
    public function __construct($base)
    {
        $this->base = $base;
    }

	/**
	 * construct 
	 * 
	 * @param \ReflectionClass $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function construct()
	{
        return clone $this->base;
	}
}

