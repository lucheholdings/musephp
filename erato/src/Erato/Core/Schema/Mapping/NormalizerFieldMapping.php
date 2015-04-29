<?php
namespace Erato\Core\Schema\Mapping;

use Clio\Component\Metadata\Mapping\AbstractMapping;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Normalizer\Context;

class NormalizerFieldMapping extends AbstractMapping
{
	private $normalizationType;

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
	 * @access public
	 * @return void
	 */
	public function getType()
	{
		if(!$this->normalizationType) {
			if($this->hasOption('ignore')) {
				$normalizationType = 'null';
			} else if($this->hasOption('type')) {
				$normalizationType = $this->getOption('type');
			} else {
				// 
				$normalizationType = $this->getMetadata()->getType();
			}

			// build type object.
			$this->normalizationType = $normalizationType; 
		}

		return $this->normalizationType;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'normalizer';
	}
}

