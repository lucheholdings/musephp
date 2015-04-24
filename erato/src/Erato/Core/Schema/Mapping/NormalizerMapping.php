<?php
namespace Erato\Core\Schema\Mapping;

use Clio\Extra\Metadata\Mapping\AbstractRegistryServiceMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Pattern\Registry\Registry;

class NormalizerMapping extends AbstractRegistryServiceMapping
{
	private $_normalizer;

	/**
	 * __construct 
	 * 
	 * @param Registry $registry 
	 * @param mixed $normalizerId 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, Registry $registry, $normalizerId, array $options = array())
	{
		parent::__construct($metadata, $registry, array('normalizer' => $normalizerId), $options);
	}

	/**
	 * setNormalizer 
	 * 
	 * @param Normalizer $normalizer 
	 * @access public
	 * @return void
	 */
	public function setNormalizer(Normalizer $normalizer)
	{
		$this->_normalizer = $normalizer;
		return $this;
	}

	/**
	 * getNormalizer 
	 * 
	 * @access public
	 * @return void
	 */
	public function getNormalizer()
	{
		if (!$this->_normalizer) {
			$this->_normalizer = $this->getService('normalizer');
		}

		return $this->_normalizer;
	}

	/**
	 * normalize 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function normalize($data)
	{
		//if($this->getMetadata() instanceof ClassMetadata) {
		//	$type = $this->getMetadata()->getName();
		//} else {
		//	$type = 'array';
		//}

		return $this->getNormalizer()->normalize($data, null, $this->createContext());
	}

	/**
	 * denormalize 
	 * 
	 * @access public
	 * @return void
	 */
	public function denormalize($data)
	{
		if ($this->getMetadata() instanceof ClassMetadata) {
			$type = $this->getMetadata()->getName();
		} else {
			$type = 'array';
		}

		return $this->getNormalizer()->denormalize($data, $type, $this->createContext());
	}

	/**
	 * createContext 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function createContext()
	{
		$context = new Context($this->getNormalizer()->getTypeRegistry());
		$context->setNormalizer($this->getNormalizer());

		return $context;
	}

	/**
	 * getType 
	 * 
	 * @access public
	 * @return void
	 */
	public function getType()
	{
		//return $this->getMetadata()->getType();
		//return new \Erato\Core\Type\SchemaType($this->getMetadata());
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'normalizer';
	}

	/**
	 * {@inheritdoc}
	 */
	public function setNormalizerId($id)
	{
		$this->setServiceId('normalizer', $id);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getNormalizerId()
	{
		return $this->getServiceId('normalizer');
	}
}

