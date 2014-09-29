<?php
namespace Clio\Component\Tool\Serializer\Strategy;

use Clio\Component\Tool\Serializer\Tool\ArrayParser;
use Clio\Component\Tool\Serializer\SerializerStrategy;
use Clio\Component\Tool\Serializer\SerializationStrategy,
	Clio\Component\Tool\Serializer\DeserializationStrategy
;

/**
 * ArrayCompatibleStrategy 
 *   Strategy 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ArrayCompatibleStrategy implements SerializerStrategy 
{
	/**
	 * arrayParser 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $arrayParser;

	/**
	 * __construct 
	 * 
	 * @param ArrayParser $parser 
	 * @access public
	 * @return void
	 */
	public function __construct(ArrayParser $parser)
	{
		$this->arrayParser = $parser;
	}
    
    /**
     * Get arrayParser.
     *
     * @access public
     * @return arrayParser
     */
    public function getArrayParser()
    {
        return $this->arrayParser;
    }
    
    /**
     * Set arrayParser.
     *
     * @access public
     * @param arrayParser the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setArrayParser($arrayParser)
    {
        $this->arrayParser = $arrayParser;
        return $this;
    }

	public function serialize($data, $format = null)
	{
		$data = $this->convertToArray($data);

		return $this->getArrayParser()->dump($data, $format);
	}

	public function canSerialize($data, $format = null)
	{
		return ('array' == $format) || $this->getArrayParser()->hasDumper($format);
	}

	public function deserialize($data, $class, $format = null)
	{
		$data = $this->getArrayParser()->parse($data, $format);

		return $this->convertFromArray($data, $class);
	}

	public function canDeserialize($data, $class, $format = null)
	{
		return ('array' == $format) || $this->getArrayParser()->hasParser($format);
	}

	abstract protected function convertFromArray(array $data, $class);

	abstract protected function convertToArray($data);
}

