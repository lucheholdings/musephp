<?php
namespace Clio\Bridge\JMSSerializer\Normalizer;

use Clio\Component\Tool\Normalizer\NormalizationStrategy,
	Clio\Component\Tool\Normalizer\DenormalizationStrategy
;
use JMS\Serializer\Serializer as JMSSerializer;
use JMS\Serializer\Context,
	JMS\Serializer\SerializationContext,
	JMS\Serializer\DeserializationContext
;

/**
 * JMSSerializerNormalizerAdapter 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NormalizerAdapter implements
	NormalizationStrategy,
	DenormalizationStrategy
{
	/**
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

	/**
	 * serializer 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $serializer;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(JMSSerializer $serializer)
	{
		$this->serializer = $serializer;
		$this->options = array();
	}

	/**
	 * canNormalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function canNormalize($object)
	{
		return true;
	}

	/**
	 * normalize 
	 *   Object to Array Conversion with JMSSerializer
	 *   With JMSSerializer, 
	 *     1. serialize to json
	 *     2. decode json to array
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function normalize($object)
	{
		return json_decode($this->getSerializer()->serialize($object, 'json', $this->applyOptionsToContext(SerializationContext::create())), true);
	}

	/**
	 * canDenormalize
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function canDenormalize($data, $class)
	{
		return true;
	}

	/**
	 * denormalize 
	 *   Array to Object Conversion 
	 *   With JMSSerializer, 
	 *     1. encode array to json
	 *     2. deserialize json to object
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function denormalize($data, $class)
	{
		return $this->getSerializer()->deserialize(json_encode($data), $class, 'json', $this->applyOptionsToContext(DeserializationContext::create()));
	}

	protected function applyOptionsToContext(Context $context)
	{
		foreach($this->getOptions() as $key => $value) {
			switch($key) {
			case 'groups':
				$context->setGroups($value);
				break;
			case 'version':
				$context->setVersion($value);
				break;
			default:
				break;
			}
		}

		return $context;
	}
    
    /**
     * Get serializer.
     *
     * @access public
     * @return serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }
    
    /**
     * Set serializer.
     *
     * @access public
     * @param serializer the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
        return $this;
    }
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}

