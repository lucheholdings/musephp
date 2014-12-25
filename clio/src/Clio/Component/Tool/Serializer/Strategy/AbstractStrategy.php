<?php
namespace Clio\Component\Tool\Serializer\Strategy;

use Clio\Component\Tool\Serializer\Strategy;
use Clio\Component\Tool\Serializer\Context;
use Clio\Component\Exception as CoreExceptions;


/**
 * AbstractStrategy 
 * 
 * @uses Strategy
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractStrategy implements Strategy
{
	/**
	 * serialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @param mixed $context 
	 * @access public
	 * @return void
	 */
	public function serialize($data, $format = null, $context = null)
	{
		return $this->doSerialize($data, $format, $context);
	}

	/**
	 * deserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $type 
	 * @param mixed $format 
	 * @param mixed $context 
	 * @access public
	 * @return void
	 */
	public function deserialize($data, $type, $format = null, $context = null)
	{
		return $this->doDeserialize($data, $type, $format , $context = null);
	}

	/**
	 * doSerialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @param Context $context 
	 * @access protected
	 * @return void
	 */
	protected function doSerialize($data, $format, Context $context)
	{
		throw new CoreExceptions\NotImplementedException();
	}

	/**
	 * doDeserialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $type 
	 * @param mixed $format 
	 * @param Context $context 
	 * @access protected
	 * @return void
	 */
	protected function doDeserialize($data, $type, $format, Context $context)
	{
		throw new CoreExceptions\NotImplementedException();
	}
}
