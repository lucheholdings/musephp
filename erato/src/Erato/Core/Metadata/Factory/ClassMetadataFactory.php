<?php
namespace Erato\Core\Metadata\Factory;

use Clio\Component\Util\Metadata\Schema\Factory\ClassMetadataFactory as BaseFactory;
use Erato\Core\Metadata\Config\Loader as ConfigLoader;

class ClassMetadataFactory extends BaseFactory 
{
	/**
	 * loader 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $loader;

	/**
	 * createMetadata 
	 * 
	 * @param mixed $schema 
	 * @access public
	 * @return void
	 */
	public function createMetadata($schema)
	{
		$loader = $this->getLoader();
		if($loader) { 
			$configs = $loader->load($schema);
		}

		$schemaMetadata = parent::createMetadata($schema);

		if($configs) {
			//
			$configs->apply($schemaMetadata);
		}
		return $schemaMetadata;
	}
    
    public function getLoader()
    {
        return $this->loader;
    }
    
    public function setLoader(ConfigLoader $loader)
    {
        $this->loader = $loader;
        return $this;
    }
}

