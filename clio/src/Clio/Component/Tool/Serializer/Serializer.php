<?php
namespace Clio\Component\Tool\Serializer;

/**
 * Serializer 
 * 
 * @uses SerializerInterface
 * @uses DeserializerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Serializer implements 
	Strategy\SerializationStrategy, 
	Strategy\DeserializationStrategy
{
	/**
	 * strategy 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $strategy;

	/**
	 * __construct 
	 * 
	 * @param Strategy $strategy 
	 * @access public
	 * @return void
	 */
	public function __construct(Strategy $strategy)
	{
		$this->strategy = $strategy;
	}

	/**
	 * serialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function serialize($data, $format = null, $context = null)
	{
		if(!$this->strategy instanceof Strategy\SerializationStrategy) {
			throw new \Clio\Component\Exception\RuntimeException('Strategy dose not support serialize.');
		}

		if(!$context) {
			$context = new Context();
		} else if(!$context instanceof Context) {
			// fixme: Try to create Context from the given data.
			$context = new Context();
		} 

		return $this->strategy->serialize($data, $format, $context);
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
		return $this->strategy->canSerialize($data, $format);
	}

	/**
	 * deserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $type 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function deserialize($data, $type, $format = null, $context = null)
	{
		if(!$this->strategy instanceof Strategy\DeserializationStrategy) {
			throw new \Clio\Component\Exception\RuntimeException('Strategy dose not support deserialize.');
		}

		if(!$context) {
			$context = new Context();
		} else if(!$context instanceof Context) {
			// fixme: Try to create Context from the given data.
			$context = new Context();
		} 

		return $this->strategy->deserialize($data, $type, $format, $context);
	}

	/**
	 * canDeserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $type 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function canDeserialize($data, $type, $format = null)
	{
		return $this->strategy->canDeserialize($data, $type, $format);
	}

	public function getSupportFormats()
	{
		return $this->getStrategy()->getSupportFormats();
	}
}

