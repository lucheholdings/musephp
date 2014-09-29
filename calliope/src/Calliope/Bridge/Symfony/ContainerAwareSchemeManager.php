<?php
namespace Calliope\Bridge\Symfony;

use Clio\Component\Pce\Metadata\ClassMetadata;
use Calliope\Framework\Core\SchemeManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface,
	Symfony\Component\DependencyInjection\ContainerInterface
;

/**
 * ContainerAwareSchemeManager 
 * 
 * @uses SchemeManager
 * @uses ContainerAwareInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ContainerAwareSchemeManager extends SchemeManager implements ContainerAwareInterface 
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
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadata $classMetadata, ContainerInterface $container = null)
	{
		parent::__construct($classMetadata);

		$this->container = $container;
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

