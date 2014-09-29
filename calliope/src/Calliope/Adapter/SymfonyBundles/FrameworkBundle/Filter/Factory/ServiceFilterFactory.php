<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Filter\Factory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Calliope\Framework\Core\Filter\Factory as FilterFactory;

/**
 * ServiceFilterFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ServiceFilterFactory implements FilterFactory 
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
		if(!isset($options['id'])) {
			throw new \InvalidArgumentException('ServiceFilterFactory requires "id" on options.');
		}

		$id = $options['id'];
		
		return $this->getContainer()->get($id);
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
}

