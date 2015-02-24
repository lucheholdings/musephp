<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Tool\Normalizer\Context;

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

