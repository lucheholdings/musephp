<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Util\Accessor\SchemaDataAccessor;
use Clio\Component\Util\Accessor\Schema\Factory as SchemaAccessorFactory;

/**
 * DataAccessorFactory 
 * 
 * @uses AbstractAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DataAccessorFactory extends AbstractAccessorFactory 
{
	/**
	 * {@inheritdoc}
	 */
	private $schemaAccessorFactory;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(SchemaAccessorFactory $schemaAccessorFactory)
	{
		$this->schemaAccessorFactory = $schemaAccessorFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createAccessor($data, array $options = array())
	{
		$schema = $this->guessSchemaFromData($data);
		return $this->createAccessorWithSchema($data, $schema, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function guessSchemaFromData($data)
	{
		if(is_object($data)) {
			return new ClassSchema(new \ReflectionClass($data));
		} else if(is_array($data)) {
			return new ArraySchema($data);
		} else {
			throw new \Exception(sprintf('Failed to guess the schema for data [%s].', gettype($data)));
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function createAccessorWithSchema($data, $schema, array $options = array())
	{
		$schemaAccessor = $this->getSchemaAccessorFactory()->createSchemaAccessor($schema, $options);
		return new SchemaDataAccessor($schemaAccessor, $data);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function createAccessorSchema($data)
	{
		return $this->getSchemaAccessorFactory($this->guessSchemaFromData($data));
	}

	protected function isSupportedData($data)
	{
		return is_object($data) || is_array($data);
	}
    
    /**
     * {@inheritdoc}
     */
    public function getSchemaAccessorFactory()
    {
        return $this->schemaAccessorFactory;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setSchemaAccessorFactory(SchemaAccessorFactory $schemaAccessorFactory)
    {
        $this->schemaAccessorFactory = $schemaAccessorFactory;
        return $this;
    }
}

