<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Context;

class NormalizerMapping extends AbstractMapping
{
	private $normalizer;

	/**
	 * setNormalizer 
	 * 
	 * @param Normalizer $normalizer 
	 * @access public
	 * @return void
	 */
	public function setNormalizer(Normalizer $normalizer)
	{
		$this->normalizer = $normalizer;
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
		return $this->normalizer;
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
		if($this->getMetadata() instanceof ClassMetadata) {
			$type = $this->getMetadata()->getName();
		} else {
			$type = 'array';
		}

		return $this->getNormalizer()->normalize($data, $type, $this->createContext());
	}

	/**
	 * denormalize 
	 * 
	 * @access public
	 * @return void
	 */
	public function denormalize($data)
	{
		if($this->getMetadata() instanceof ClassMetadata) {
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
		$context = new Context();
		$context->setNormalizer($this->getNormalizer());

		return $context;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'normalizer';
	}
}

