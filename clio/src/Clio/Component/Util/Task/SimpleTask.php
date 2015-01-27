<?php
namespace Clio\Component\Util\Task;

/**
 * SimpleTask 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SimpleTask implements Task
{
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * arguments 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $arguments;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @param array $arguments 
	 * @access public
	 * @return void
	 */
	public function __construct($name, array $arguments = array())
	{
		$this->name = $name;
		$this->arguments = $arguments;
	}
    
    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * getArguments 
     * 
     * @access public
     * @return void
     */
    public function getArguments()
    {
        return $this->arguments;
    }
    
    /**
     * setArguments 
     * 
     * @param mixed $arguments 
     * @access public
     * @return void
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }
}

