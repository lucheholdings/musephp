<?php
namespace Erato\Core\Normalizer;

use Clio\Component\Tool\Normalizer\Context,
	Clio\Component\Tool\Normalizer\Strategy,
	Clio\Component\Tool\Normalizer\Type,
	Clio\Component\Tool\Normalizer\Type\ObjectType
;
use Erato\Core\CodingStandard;
use Erato\Core\ArrayTool\PropertyToArrayKeyMapper;

/**
 * Normalizer 
 * 
 * @uses BaseNormalizer
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Normalizer extends BaseNormalizer 
{
	protected $codingStandard;

	public function __construct(Strategy $strategy, CodingStandard $codingStandard = null)
	{
		parent::__construct($strategy);

		// Use default CodingStandard
		if(!$codingStandard) {
			$codingStandard = new CodingStandard();
		}
		$this->codingStandard = $condingStandard;
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
    
	public function getKeyMapper()
	{
		$mapper = new PropertyToArrayKeyMapper($this->getCodingStandard());
	}

    public function getCodingStandard()
    {
        return $this->codingStandard;
    }
    
    public function setCodingStandard(CodingStandard $codingStandard)
    {
        $this->codingStandard = $codingStandard;
        return $this;
    }
}

