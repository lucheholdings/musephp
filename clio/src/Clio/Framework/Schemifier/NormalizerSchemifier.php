<?php
namespace Clio\Framework\Schemifier;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Schemifier\Schemifier,
	Clio\Component\Tool\Schemifier\AbstractSchemifier;
use Clio\Component\Tool\Schemifier\FieldMapperRegistry;

use JMS\Serializer\Exception\Exception as SerializerException; 

use Clio\Component\Tool\ArrayTool\InverseMapper;
/**
 * NormalizerSchemifier 
 *   Use Normalizer to convert, normalize/denormalize, data.
 * 
 * @uses AbstractSchemifier
 * @uses Schemifier
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NormalizerSchemifier extends AbstractSchemifier implements Schemifier
{
	/**
	 * normalizer 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $normalizer;

	/**
	 * __construct 
	 * 
	 * @param ReflectionClass $schemeClass
	 * @param Normalizer $normalizer 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $schemeClass, Normalizer $normalizer = null, FieldMapperRegistry $registry = null)
	{
		parent::__construct($schemeClass, $registry);

		$this->normalizer = $normalizer;
	}

	/**
	 * schemify 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function schemify($data, array $options = array())
	{
		$schemeClass = $this->getSchemeClass()->getName();
		$model = null;

		$mapper = $this->createFieldMapperFor($data, isset($options['field_mappings']) ? $options['field_mappings'] : array()); 

		if(is_object($data)){
			
			if($data instanceof $schemeClass) {
				// Already schemified
				return $data;
			} else {
				$normalized = null;
				try {
					$normalized = $this->getNormalizer()->normalize($data);
				} catch(SerializerException $ex) {
					throw new \RuntimeException(sprintf('Failed to normalize data "%s"', get_class($data)), 0, $ex);
				}

				$data = $normalized;
			}
		} else if(!is_array($data)) {
			throw new \InvalidArgumentException('schemify only support schemed data which is an array or an object.');
		}

		try {
			$model = $this->getNormalizer()->denormalize($data, $schemeClass, $mapper);
		} catch(SerializerException $ex) {
			throw new \RuntimeException(sprintf('Failed to denormalize class "%s"', $schemeClass), 0, $ex);
		}
		return $model;
	}
    
    /**
     * Get normalizer.
     *
     * @access public
     * @return normalizer
     */
    public function getNormalizer()
    {
        return $this->normalizer;
    }
    
    /**
     * Set normalizer.
     *
     * @access public
     * @param normalizer the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setNormalizer($normalizer)
    {
        $this->normalizer = $normalizer;
        return $this;
    }
}

