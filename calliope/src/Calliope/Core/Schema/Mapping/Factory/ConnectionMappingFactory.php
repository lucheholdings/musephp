<?php
namespace Calliope\Core\Schema\Mapping\Factory;

use Calliope\Core\Connection;
use Clio\Component\Metadata;

/**
 * ConnectionMappingFactory 
 * 
 * @uses AbstractSchemaMetadataMappingFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ConnectionMappingFactory extends Metadata\Mapping\Factory\AbstractFactory 
{
    /**
     * connectionFactory 
     * 
     * @var mixed
     * @access private
     */
    private $connectionFactory;

    /**
     * __construct 
     * 
     * @param TypedConnectionFactory $connectionFactory 
     * @access public
     * @return void
     */
    public function __construct(Connection\TypedFactory $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
    }

    /**
     * {@inheritdoc}
     */
	protected function doCreateMapping(Metadata $metadata, array $options)
	{
		if(($metadata instanceof Metadata\Schema) && isset($options['connect_type']) && isset($options['connect_to'])) {
			$mapping = new ConnectionMapping($metadata, $this->connectionFactory, $options);
		} else {
			throw new Metadata\Exception\UnsupportedException('"connect_type" and "connect_to" is required to create ConnectionMapping');
		}

		return $mapping;
	}
    
    /**
     * getConnectionFactory 
     * 
     * @access public
     * @return void
     */
    public function getConnectionFactory()
    {
        return $this->connectionFactory;
    }
    
    /**
     * setConnectionFactory 
     * 
     * @param mixed $connectionFactory 
     * @access public
     * @return void
     */
    public function setConnectionFactory(Connection\TypedFactory $connectionFactory)
    {
        $this->connectionFactory = $connectionFactory;
        return $this;
    }
}

