<?php
namespace Clio\Component\Util\Metadata\Factory;

use Clio\Component\Util\Metadata;
use Clio\Component\Pattern\Factory\MappedFactory;
use Clio\Component\Util\Type as Types;
/**
 * SchemaFactory 
 *   Factory to create SchemaMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaFactory implements Metadata\Factory, MappedFactory 
{
    /**
     * schemaResolver 
     * 
     * @var mixed
     * @access private
     */
    private $schemaResolver;

    /**
     * typeResolver 
     * 
     * @var mixed
     * @access private
     */
    private $typeResolver;

    /**
     * mappingFactories 
     * 
     * @var mixed
     * @access private
     */
	private $mappingFactories;

	/**
	 * __construct 
	 * 
	 * @param mixed $mappingFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata\Resolver $schemaResolver, Types\Resolver $typeResolver, array $mappingFactories = array())
	{
        $this->schemaResolver = $schemaResolver;
        $this->typeResolver = $typeResolver;
		$this->mappingFactories = $mappingFactories;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKey($key)
	{
		$args = func_get_args();
        array_shift($args);

		return $this->createSchemaMetadata($key, $args);
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKeyArgs($key, array $args = array())
	{
		return $this->createSchemaMetadata($key);
	}

	/**
	 * createSchemaMetadata 
	 * 
	 * @param mixed $schema 
	 * @access public
	 * @return void
	 */
	public function createSchemaMetadata($type)
	{
        $builder = $this->createBuilder();

        return $builder
            ->setType($type)
            ->appendProperties()
            ->getSchemaMetadata()
        ;
	}
    
	/**
	 * {@inheritdoc}
	 */
	public function canCreateArgs(array $args = array())
	{
		return $this->canCreateByKey(array_shift($args), $args);
	}

	/**
	 * canCreateByKey
	 * 
	 * @param mixed $key 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function canCreateByKey($key, array $args = array())
	{
		return $this->isSupportedSchema($key);
	}

	/**
	 * isSupportedSchema 
	 * 
	 * @param mixed $schema 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	public function isSupportedSchema($schema)
    {
        try {
            return (bool)$this->getTypeResolver()->resolve($schema);
        } catch(ResolverException $exception) {
            return false;
        }
    }

    public function createBuilder()
    {
        return new Metadata\Builder\SchemaBuilder($this->schemaResolver, $this->typeResolver, $this->mappingFactories);
    }
    
    public function getSchemaResolver()
    {
        return $this->schemaResolver;
    }
    
    public function setSchemaResolver(Metadata\Schema\Resolver $schemaResolver)
    {
        $this->schemaResolver = $schemaResolver;
        return $this;
    }
    
    public function getTypeResolver()
    {
        return $this->typeResolver;
    }
    
    public function setTypeResolver(Types\Resolver $typeResolver)
    {
        $this->typeResolver = $typeResolver;
        return $this;
    }
    
    public function getMappingFactories()
    {
        return $this->mappingFactories;
    }
    
    public function setMappingFactories(array $mappingFactories)
    {
        $this->mappingFactories = $mappingFactories;
        return $this;
    }
}

