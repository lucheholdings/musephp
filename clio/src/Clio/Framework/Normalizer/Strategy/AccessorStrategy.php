<?php
namespace Clio\Framework\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy\ObjectStrategy;
use Clio\Component\Tool\Normalizer\Strategy\NormalizationStrategy,
	Clio\Component\Tool\Normalizer\Strategy\DenormalizationStrategy
;
use Clio\Component\Util\Accessor\Factory\ObjectAccessorFactory;
use Clio\Component\Util\Accessor\SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Factory\BasicClassAccessorFactory;
use Clio\Component\Tool\Normalizer\Context,
	Clio\Component\Tool\Normalizer\Type
;

/**
 * AccessorStrategy 
 * 
 * @uses ObjectStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AccessorStrategy extends ObjectStrategy implements NormalizationStrategy, DenormalizationStrategy
{
	static public function createDefault()
	{
		return new self(BasicClassAccessorFactory::createDefaultFactory());
	}

	private $accessorFactory;

	/**
	 * __construct 
	 * 
	 * @param ClassMetadataRegistry $registry 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaAccessorFactory $accessorFactory)
	{
		$this->accessorFactory = new ObjectAccessorFactory($accessorFactory);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doNormalize($data, Type $type, Context $context)
	{
		$accessor = $this->createDataAccessor($type, $data); 

		return $accessor->getFieldValues();
	}


	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		if(!$object) {
			// create new Object
			$object = $type->construct();
		}

		$accessor = $this->createDataAccessor($type, $object); 
		
		// Set Field Values
		foreach($data as $key => $value) {
			$accessor->set($key, $value);
		}

		return $accessor->getData();
	}

	/**
	 * createAccessorWithSchema 
	 * 
	 * @param Type $type 
	 * @param mixed $data 
	 * @access protected
	 * @return void
	 */
	protected function createDataAccessor(Type $type, $data)
	{
		return $this->getAccessorFactory()->createAccessorWithSchema($data, $type->getClassReflector());
	}
    
    public function getAccessorFactory()
    {
        return $this->accessorFactory;
    }
    
    public function setAccessorFactory($accessorFactory)
    {
        $this->accessorFactory = $accessorFactory;
        return $this;
    }
}

