<?php
namespace Clio\Extra\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy\ObjectStrategy;
use Clio\Component\Tool\Normalizer\Strategy\NormalizationStrategy,
	Clio\Component\Tool\Normalizer\Strategy\DenormalizationStrategy
;
use Clio\Component\Util\Accessor\Accessor;
use Clio\Component\Util\Accessor\Factory\DataAccessorFactory;
use Clio\Component\Util\Accessor\SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Factory\BasicClassAccessorFactory;
use Clio\Component\Tool\Normalizer\Context,
	Clio\Component\Tool\Normalizer\Type
;

use Clio\Component\Util\Accessor\Schema\Registry as SchemaAccessorRegistry;
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
	/**
	 * {@inheritdoc}
	 */
	private $accessorFactory;

	/**
	 * __construct 
	 * 
	 * @param ClassMetadataRegistry $registry 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaAccessorRegistry $accessorRegistry)
	{
		$this->accessorFactory = new DataAccessorFactory($accessorRegistry);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doNormalize($data, Type $type, Context $context)
	{
		$accessor = $this->createDataAccessor($type, $data); 

		return $accessor->getFieldValues();
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		if(!$object) {
			// create new Object
			$object = $type->construct();
		}

		$accessor = $this->createDataAccessor($type, $object); 
		
		// Set Field Values
		foreach($data as $key => $value) {
			//if($accessor->existsField($key)) {
			if($accessor->isSupportMethod($key, Accessor::ACCESS_SET)) {
				$accessor->set($key, $value);
			} else {
				throw new \InvalidArgumentException(sprintf('Field "%s" is not exists.', $key));
			}
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
		return $this->getAccessorFactory()->createAccessorWithSchema($data, $type->getName());
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

