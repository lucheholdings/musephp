<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Filter\Factory;

use Calliope\Core\Filter\Factory as FilterFactory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Calliope\Adapter\SymfonyBundles\FrameworkBundle\Filter\ActiveUserFilter;

/**
 * ActiveUserFilterFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ActiveUserFilterFactory implements FilterFactory 
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $container;

	/**
	 * __construct 
	 * 
	 * @param ContainerInterface $container 
	 * @access public
	 * @return void
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createFilter(array $options = array())
	{
		if(!isset($options['field'])) {
			throw new \InvalidArgumentException('ActiveUserFilterFactory requires "id" on options.');
		}

		$field = $options['field'];
		
		return new ActiveUserFilter($options['field'], $this->getSecurityContext(), isset($options['readonly']) ? true : false, isset($options['setter']) ? $options['setter'] : 'setUser');
	}
    
    /**
     * getContainer 
     * 
     * @access public
     * @return void
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * setContainer 
     * 
     * @param mixed $container 
     * @access public
     * @return void
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

	public function getSecurityContext()
	{
		return $this->getContainer()->get('security.context');
	}
}

