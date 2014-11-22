<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Connection;
use Calliope\Core\SchemaManagerInterface;

/**
 * AbstractConnection 
 * 
 * @uses Connection
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractConnection implements Connection 
{
	/**
	 * connectFrom
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $connectFrom;

	/**
	 * connectTo 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $connectTo;

	/**
	 * options 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $options;

	/**
	 * __construct 
	 * 
	 * @param SchemaManagerInterface $connectFrom 
	 * @param mixed $connectTo 
	 * @access public
	 * @return void
	 */
	public function __construct($connectTo = null, array $options = array())
	{
		$this->connectTo = null;
		$this->options = $options;

		if($connectTo) {
			$this->setConnectTo($connectTo);
		}
	}
    
    /**
     * Get connectFrom.
     *
     * @access public
     * @return connectFrom
     */
    public function getConnectFrom()
    {
        return $this->connectFrom;
    }
    
    /**
     * Set connectFrom.
     *
     * @access public
     * @param connectFrom the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConnectFrom(SchemaManagerInterface $connectFrom)
    {
        $this->connectFrom = $connectFrom;
        return $this;
    }
    
    /**
     * Get connectTo.
     *
     * @access public
     * @return connectTo
     */
    public function getConnectTo()
    {
        return $this->connectTo;
    }
    
    /**
     * Set connectTo.
     *
     * @access public
     * @param connectTo the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConnectTo($connectTo)
    {
		$this->validateConnectTo($connectTo);
		$this->connectTo = $connectTo;
        return $this;
    }

	/**
	 * validateConnectTo 
	 * 
	 * @param mixed $connectTo 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function validateConnectTo($connectTo);

	/**
	 * {@inheritdoc}
	 */
	public function flush()
	{
	}
}

