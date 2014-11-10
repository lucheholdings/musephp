<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Util\Accessor\SchemaDataAccessor;
use Clio\Component\Util\Accessor\Schema\AccessorRegistry as SchemaAccessorRegistry;

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
	private $schemaAccessorRegistry;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(SchemaAccessorRegistry $schemaAccessorRegistry)
	{
		$this->schemaAccessorRegistry = $schemaAccessorRegistry;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createAccessor($data, array $options = array())
	{
		$schema = $this->guessSchemaNameFromData($data);
		return $this->createAccessorWithSchema($data, $schema, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function guessSchemaNameFromData($data)
	{
		if(is_object($data)) {
			return get_class($data);
		} else if(is_array($data)) {
			return 'array';
		} else {
			throw new \Exception(sprintf('Failed to guess the schema for data [%s].', gettype($data)));
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function createAccessorWithSchema($data, $schema, array $options = array())
	{
		$schemaAccessor = $this->getSchemaAccessorRegistry()->get($schema, $options);
		return new SchemaDataAccessor($schemaAccessor, $data);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function createAccessorSchema($data)
	{
		return $this->getSchemaAccessorRegistry($this->guessSchemaFromData($data));
	}

	protected function isSupportedData($data)
	{
		return is_object($data) || is_array($data);
	}
    
    /**
     * {@inheritdoc}
     */
    public function getSchemaAccessorRegistry()
    {
        return $this->schemaAccessorRegistry;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setSchemaAccessorRegistry(SchemaAccessorRegistry $schemaAccessorRegistry)
    {
        $this->schemaAccessorRegistry = $schemaAccessorRegistry;
        return $this;
    }
}

