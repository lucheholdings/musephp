<?php
namespace Calliope\Bridge\Symfony\Factory;

use Calliope\Framework\Core\Factory\SchemeManagerComponentFactory;
use Clio\Component\Pce\Construction\InheritComponentFactory;
use Clio\Framework\Metadata\ClassMetadataRegistry;
use Calliope\Framework\Core\Connection\Factory\TypeConnectionFactory;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * ContainerAwareSchemeManagerFactory 
 * 
 * @uses SchemeManagerComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ContainerAwareSchemeManagerFactory extends SchemeManagerComponentFactory implements ContainerAwareInterface
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
	 * @param ClassMetadataRegistry $registry 
	 * @param TypeConnectionFactory $typeConnectionFactory 
	 * @param ContainerInterface $container 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadataRegistry $registry, TypeConnectionFactory $typeConnectionFactory, $filterFactory, ContainerInterface $container = null)
	{
		parent::__construct($registry, $typeConnectionFactory, $filterFactory);
		$this->container = $container;
	}

	/**
	 * createSchemeManager 
	 * 
	 * @param mixed $schemeClass 
	 * @param mixed $connectionType 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createSchemeManager($schemeClass, $connectionType, $connectTo, array $filters = array(), array $options = array())
	{
		$manager = parent::createSchemeManager($schemeClass, $connectionType, $connectTo, $filters, $options);

		if($this->container && ($manager instanceof ContainerAwareInterface)) {
			$manager->setContainer($this->container);
		}
		return $manager;
	}
    
    /**
     * Get container.
     *
     * @access public
     * @return container
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * Set container.
     *
     * @access public
     * @param container the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }
}

