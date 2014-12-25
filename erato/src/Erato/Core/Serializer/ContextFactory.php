<?php
namespace Erato\Core\Serializer;

use Clio\Component\Tool\Serializer\ContextFactory as ContextFactoryInterface;
use Clio\Component\Tool\Serializer\Context;
use Erato\Core\ArrayTool\PropertyToArrayKeyMapper;
use Erato\Core\CodingStandard;

/**
 * ContextFactory 
 * 
 * @uses ContextFactoryInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ContextFactory implements ContextFactoryInterface 
{
	private $codingRule;

	public function __construct(CodingStandard $codingRule)
	{
		$this->codingRule = $codingRule;
	}

	public function createContext(array $context = array())
	{
		return new Context(array_merge($context, array(
			'field_mapper' => new PropertyToArrayKeyMapper($this->getCodingRule())
		)));
	}
    
    public function getCodingRule()
    {
        return $this->codingRule;
    }
    
    public function setCodingRule($codingRule)
    {
        $this->codingRule = $codingRule;
        return $this;
    }
}

