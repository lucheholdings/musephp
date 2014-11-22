<?php
namespace Erato\Core\Factory;

use Erato\Core\Metadata\MetadataRegistry;
use Clio\Component\Pattern\Factory\AbstractFactory;
use Erato\Core\SchemaMetadata;

/**
 * SchemaMetadataFactory 
 * 
 * @uses AbstractFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaMetadataFactory extends AbstractFactory 
{
	private $metadataRegistry;

	/**
	 * __construct 
	 * 
	 * @param MetadataRegistry $metadataRegistry 
	 * @access public
	 * @return void
	 */
	public function __construct(MetadataRegistry $metadataRegistry)
	{
		$this->metadataRegistry = $metadataRegistry;

		parent::__construct($metadataRegistry);
	}

	/**
	 * createManager 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function createManager($name)
	{
		return $this->doCreateManager($name);
	}

	/**
	 * doCreateManager 
	 * 
	 * @param mixed $name 
	 * @access protected
	 * @return void
	 */
	protected function doCreateManager($name)
	{
		if(!$this->getMetadataRegsitry()->has($name)) {
			throw new \Exception(sprintf('Metadata for "%s" is not exists on MetadataRegistry.', $name));
		}

		return new SchemaMetadata($this->getMetadataRegistry()->get($name));
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreate(array $args)
	{
		$name = array_shift($args);

		return $this->doCreateManager($name);
	}
    
    /**
     * getMetadataRegistry 
     * 
     * @access public
     * @return void
     */
    public function getMetadataRegistry()
    {
        return $this->metadataRegistry;
    }
    
    /**
     * setMetadataRegistry 
     * 
     * @param mixed $metadataRegistry 
     * @access public
     * @return void
     */
    public function setMetadataRegistry($metadataRegistry)
    {
        $this->metadataRegistry = $metadataRegistry;
        return $this;
    }
}

