<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Container\Map\Factory;

use Doctrine\Common\Persistence\ManagerRegistry as DoctrineRegistry;

class DoctrineOrmMapFactory extends AbstractMapFactory
{
	private $doctrine;

	public function __construct(DoctrineRegistry $doctrine)
	{
		parent::__construct();
		$this->doctrine = $doctrine;
	}

	protected function resolveArguments(array $args = array())
	{
		$args[0] = $this->getDoctrine()->getManager($args[0]);
	
		return $args;
	}

	protected function getStorageClass()
	{
		return '\Clio\Bridge\DoctrineOrm\Container\Storage\RandomAccessStorage';
	}
    
    public function getDoctrine()
    {
        return $this->doctrine;
    }
    
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
        return $this;
    }
}

