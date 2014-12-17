<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Tool\Normalizer\Context;

class NormalizerFieldMapping extends AbstractMapping
{
	/**
	 * __construct 
	 * 
	 * @param Registry $registry 
	 * @param mixed $normalizerId 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, array $options = array())
	{
		parent::__construct($metadata, $options);
	}

	/**
	 * getType 
	 * 
	 * @param Context $context 
	 * @access public
	 * @return void
	 */
	public function getType(Context $context)
	{
		if($this->hasOption('type')) {
			return $this->getOption('type');
		}
		return $context->getTypeRegistry()->getType($this->getMetadata()->getType());
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'normalizer';
	}
}

