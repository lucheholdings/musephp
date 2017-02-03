<?php
namespace Clio\Bridge\JMSSerializer\Serializer;

use JMS\Serializer\SerializerInterface;

use Clio\Component\Serializer\SerializationStrategy,
	Clio\Component\Serializer\DeserializationStrategy
;
/**
 * SerializerAdapter 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SerializerAdapter implements 
	SerializationStrategy,
	DeserializationStrategy
{
	const FORMAT_JSON = 'json';

	const FORMAT_XML  = 'xml';

	const FORMAT_YAML = 'yml';

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(SerializerInterface $serializer)
	{
		$this->serializer = $serializer;
	}

	/**
	 * deserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function deserialize($data, $class, $format = null)
	{
		if($this->isSupportedContentType($format)) {
			$format = $this->getFormatFromContentType($format);
		} else if (!$this->isSupportedFormat($format)) {
			throw new \InvalidArgumentException(sprintf('Unsupported format "%s" to serialize.', $format));
		}

		// Call JMS Deserializer
		// Call JMS Serializer 
		switch($format) {
		case self::FORMAT_ARRAY:
			return $this->serializer->deserialize(json_encode($data), $class, 'json');
			break;
		default:
			return $this->serializer->deserialize($data, $class, $format);
			break;
		}
	}

	/**
	 * canDeserialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function canDeserialize($data, $class, $format = null)
	{
		return ($this->isSupportedContentType($format))|| (!$this->isSupportedFormat($format));
	}

	/**
	 * serialize
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function serialize($data, $format = null)
	{
		if($this->isSupportedContentType($format)) {
			$format = $this->getFormatFromContentType($format);
		} else if (!$this->isSupportedFormat($format)) {
			throw new \InvalidArgumentException(sprintf('Unsupported format resource "%s" to deserialize', $format));
		}
		
		// Call JMS Serializer 
		switch($format) {
		case self::FORMAT_ARRAY:
			return json_decode($this->serializer->serialize($data, 'json'), true);
			break;
		default:
			return $this->serializer->serialize($data, $format);
			break;
		}
	}

	/**
	 * canSerialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function canSerialize($data, $format = null)
	{
		return ($this->isSupportedContentType($format)) || (!$this->isSupportedFormat($format));
	}

	/**
	 * getSupportedTypeMaps 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSupportedTypeMaps()
	{
		return $contentTypes = array(
			'application/json' => self::FORMAT_JSON,
			'application/yaml' => self::FORMAT_YAML,
			'application/xml'  => self::FORMAT_XML,
		);
	}
}

