<?php
namespace Clio\Bridge\JMSSerializer\Normalizer;

use Clio\Component\Tool\Normalizer\Strategy\NormalizationStrategy,
	Clio\Component\Tool\Normalizer\Strategy\DenormalizationStrategy,
	Clio\Component\Tool\Normalizer\Strategy\AbstractStrategy
;
use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type;

use JMS\Serializer\Serializer as JMSSerializer;
use JMS\Serializer\Context as JMSContext,
	JMS\Serializer\SerializationContext,
	JMS\Serializer\DeserializationContext
;

/**
 * JMSSerializerStrategy 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class JMSSerializerStrategy extends AbstractStrategy implements
	NormalizationStrategy,
	DenormalizationStrategy
{
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
	public function __construct(JMSSerializer $serializer, array $options = array())
	{
		$this->serializer = $serializer;
		parent::__construct($options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return true;
	}

	/**
	 * {@inheritdoc}
	 * 
	 *   Object to Array Conversion with JMSSerializer
	 *   With JMSSerializer, 
	 *     1. serialize to json
	 *     2. decode json to array
	 */
	protected function doNormalize($data, Type $type, Context $context)
	{
		return json_decode($this->getSerializer()->serialize($data, 'json', $this->applyOptionsToContext(SerializationContext::create())), true);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return true;
	}

	/**
	 * {@inheritdoc}
	 *   Array to Object Conversion 
	 *   With JMSSerializer, 
	 *     1. encode array to json
	 *     2. deserialize json to object
	 */
	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		return $this->getSerializer()->deserialize(json_encode($data), $type->getName(), 'json', $this->applyOptionsToContext(DeserializationContext::create()));
	}

	/**
	 * applyOptionsToContext 
	 * 
	 * @param JMSContext $context 
	 * @access protected
	 * @return void
	 */
	protected function applyOptionsToContext(JMSContext $context)
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
    public function setSerializer(JMSSerializer $serializer)
    {
        $this->serializer = $serializer;
        return $this;
    }
}

