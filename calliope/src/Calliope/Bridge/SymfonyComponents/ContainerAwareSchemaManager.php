<?php
namespace Calliope\Bridge\Symfony;

use Clio\Component\Util\Metadata\Schema\ClassMetadata;
// todo: SchemaManager is not defined, but Calliope\Core\Manager interface is extended from Erato\Core\SchemaManager interface.
// Is required an interface is Calliope\Core\Manager?
use Calliope\Framework\Core\SchemaManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface,
	Symfony\Component\DependencyInjection\ContainerInterface
;

/**
 * ContainerAwareSchemaManager 
 * 
 * @uses SchemaManager
 * @uses ContainerAwareInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ContainerAwareSchemaManager extends SchemaManager implements ContainerAwareInterface 
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

