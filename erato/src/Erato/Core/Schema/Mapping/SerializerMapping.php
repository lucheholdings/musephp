<?php
namespace Erato\Core\Schema\Mapping;

use Clio\Extra\Metadata\Mapping\AbstractRegistryServiceMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Tool\Serializer\Serializer;
use Clio\Component\Tool\Serializer\Context;
use Clio\Component\Pattern\Registry\Registry;

class SerializerMapping extends AbstractRegistryServiceMapping
{
	private $_serializer;

	/**
	 * __construct 
	 * 
	 * @param Registry $registry 
	 * @param mixed $serializerId 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, Registry $registry, $serializerId, array $options = array())
	{
		parent::__construct($metadata, $registry, array('serializer' => $serializerId), $options);
	}

	/**
	 * setSerializer 
	 * 
	 * @param Serializer $serializer 
	 * @access public
	 * @return void
	 */
	public function setSerializer(Serializer $serializer)
	{
		$this->_serializer = $serializer;
		return $this;
	}

	/**
	 * getSerializer 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSerializer()
	{
		if($this->_serializer) {
			$this->_serializer = $this->getService('serializer');
		}
		return $this->_serializer;
	}

	/**
	 * createContext 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function createContext()
	{
		$context = new Context();
		$context->setSerializer($this->getSerializer());

		return $context;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'serializer';
	}

	/**
	 * {@inheritdoc}
	 */
	public function setSerializerId($id)
	{
		$this->setServiceId('serializer', $id);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSerializerId()
	{
		return $this->getServiceId('serializer');
	}
}

