<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Kvs\Factory;

class DoctrineOrmFactory extends AbstractKvsFactory 
{
	public function __construct($doctrineRegistry)
	{
		$this->doctrineRegistry = $doctrineRegistry;
	}

	private function getStorageClass()
	{
		return 'Clio\Bridge\DoctrineOrm\FetchMap';
	}
}

