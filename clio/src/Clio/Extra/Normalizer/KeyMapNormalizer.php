<?php
namespace Clio\Extra\Normalizer;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Context,
	Clio\Component\Tool\Normalizer\Strategy,
	Clio\Component\Tool\Normalizer\Type,
	Clio\Component\Tool\Normalizer\Type\ObjectType
;
use Clio\Component\Tool\ArrayTool\Mapper,
	Clio\Component\Tool\ArrayTool\DummyMapper;

/**
 * KeyMapNormalizer 
 *   KeyMapNormalizer is a normalizer which convert key for normalized value. 
 * @uses BaseNormalizer
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class KeyMapNormalizer extends Normalizer 
{
	protected $keyMapper;

	public function __construct(Strategy $strategy, Mapper $keyMapper = null)
	{
		parent::__construct($strategy);

		if(!$keyMapper) {
			$keyMapper = new DummyMapper(); 
		}
		$this->keyMapper = $keyMapper;
	}

	public function normalize($data, $type = null, Context $context = null)
	{
		if(!$context) {
			$context = new Context();
			$context->setNormalizer($this);
		}

		if(!$type) {
			$type = $context->getTypeRegistry()->guessType($data);
		} else if(!$type instanceof Type) {
			$type = $context->getTypeRegistry()->getType($type);
		}

		$normalized = parent::normalize($data, $type, $context);

		// 
		if($type instanceof ObjectType) {
			$normalized = $this->getKeyMapper()->map($normalized);
		}

		return $normalized;
	}

	public function denormalize($data, $type, Context $context = null)
	{
		if(!$context) {
			$context = new Context();
			$context->setNormalizer($this);
		}

		if(!$type instanceof Type) {
			$type = $context->getTypeRegistry()->getType($type);
		}

		if(is_array($data) && ($type instanceof ObjectType)) {
			$data = $this->getKeyMapper()->inverseMap($data);
		}
		return parent::denormalize($data, $type, $context);
	}
    
	/**
	 * getKeyMapper 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKeyMapper()
	{
		return $this->keyMapper;
	}

	/**
	 * setKeyMapper 
	 * 
	 * @param Mapper $keyMapper 
	 * @access public
	 * @return void
	 */
	public function setKeyMapper(Mapper $keyMapper)
	{
		$this->keyMapper = $keyMapper;
	}
}

