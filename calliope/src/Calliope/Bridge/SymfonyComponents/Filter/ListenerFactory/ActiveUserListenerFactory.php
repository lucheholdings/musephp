<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\ListenerFactory;

use Calliope\Bridge\SymfonyComponents\Filter\ListenerFactory;
use Symfony\Component\Security\Core\SecurityContext;
use Clio\Component\Metadata\SchemaRegistry as SchemaRegistry;
use Calliope\Bridge\SymfonyComponents\Filter\Listener\ActiveUserListener;

/**
 * ActiveUserListenerFactory 
 * 
 * @uses AbstractFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ActiveUserListenerFactory extends AbstractFactory 
{
	/**
	 * securityContext 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $securityContext;

	/**
	 * schemaRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemaRegistry;

	/**
	 * __construct 
	 * 
	 * @param SecurityContext $securityContext 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(SecurityContext $securityContext = null, SchemaRegistry $schemaRegistry = null, array $options = array())
	{
		$this->securityContext = $securityContext;
		$this->schemaRegistry = $schemaRegistry;
		parent::__construct($options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function createFilterListener(array $options = array())
	{
		$options = $this->getMergedOptions($options);
		$listener = new ActiveUserListener($this->getSecurityContext(), $this->getSchemaRegistry(), $options);

		return $listener;
	}
    
    /**
     * getSecurityContext 
     * 
     * @access public
     * @return void
     */
    public function getSecurityContext()
    {
        return $this->securityContext;
    }
    
    /**
     * setSecurityContext 
     * 
     * @param SecurityContext $securityContext 
     * @access public
     * @return void
     */
    public function setSecurityContext(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
        return $this;
    }
    
    public function getSchemaRegistry()
    {
        return $this->schemaRegistry;
    }
    
    public function setSchemaRegistry($schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }
}

