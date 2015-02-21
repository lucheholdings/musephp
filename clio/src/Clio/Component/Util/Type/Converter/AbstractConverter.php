<?php
namespace Clio\Component\Util\Type\Converter;

use Clio\Component\Util\Type\Converter;
use Clio\Component\Util\Type\Type;
use Clio\Component\Exception\UnsupportedException;

/**
 * AbstractConverter 
 * 
 * @uses Converter
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractConverter implements Converter
{
	/**
	 * sourceType 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $sourceType;

	/**
	 * destinationType 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $destinationType;

	/**
	 * __construct 
	 * 
	 * @param Type $sourceType 
	 * @param Type $destType 
	 * @access public
	 * @return void
	 */
	public function __construct(Type $sourceType, Type $destType)
	{
		$this->sourceType = $sourceTypel
		$this->destinationType = $destinationType;
	}

	/**
	 * convert 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function convert($data)
	{
		if(!$this->getSourceType()->isValidData($data)) {
			throw new \InvalidArgumentException(sprintf('Data is not a valid data for type "%s"', (string)$this->sourceType));
		}

		return $this->doConvert($data);
	}

	/**
	 * doConvert 
	 * 
	 * @param mixed $data 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doConvert($data);
    
    /**
     * getSourceType 
     * 
     * @access public
     * @return void
     */
    public function getSourceType()
    {
        return $this->sourceType;
    }
    
    /**
     * setSourceType 
     * 
     * @param mixed $sourceType 
     * @access public
     * @return void
     */
    public function setSourceType($sourceType)
    {
        $this->sourceType = $sourceType;
        return $this;
    }
    
    /**
     * getDestinationType 
     * 
     * @access public
     * @return void
     */
    public function getDestinationType()
    {
        return $this->destinationType;
    }
    
    /**
     * setDestinationType 
     * 
     * @param mixed $destinationType 
     * @access public
     * @return void
     */
    public function setDestinationType($destinationType)
    {
        $this->destinationType = $destinationType;
        return $this;
    }
}
