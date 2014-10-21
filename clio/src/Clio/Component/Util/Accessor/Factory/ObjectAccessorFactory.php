<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Util\Accessor\ObjectAccessor;

/**
 * ObjectAccessorFactory 
 * 
 * @uses AbstractAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ObjectAccessorFactory extends AbstractAccessorFactory 
{
	/**
	 * {@inheritdoc}
	 */
	private $schemaAccessorFactory;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(ClassAccessorFactory $schemaAccessorFactory)
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
		return new \ReflectionClass($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function createAccessorWithSchema($data, $schema, array $options = array())
	{
		$schemaAccessor = $this->getSchemaAccessorFactory()->createSchemaAccessor($schema);
		return new ObjectAccessor($schemaAccessor, $data);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function createAccessorSchema($data)
	{
		return $this->getSchemaAccessorFactory(new \ReflectionClass());
	}

	protected function isSupportedData($data)
	{
		return is_object($data);
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
    public function setSchemaAccessorFactory($schemaAccessorFactory)
    {
        $this->schemaAccessorFactory = $schemaAccessorFactory;
        return $this;
    }
}

