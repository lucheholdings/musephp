<?php
namespace Calliope\Framework\WebQuery\Tests\Resolver;

use Calliope\Framework\WebQuery\Resolver\ConditionResolver;
use Calliope\Framework\WebQuery\Expression\Expression;
use Calliope\Framework\WebQuery\Comparisons;
/**
 * ConditionResolverTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ConditionResolverTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testParse 
	 * 
	 * @access public
	 * @return void
	 */
	public function testParse()
	{
		$resolver = new ConditionResolver();

		$condition = $resolver->resolveCondition('tags', '=:test');

		$this->assertInstanceOf('Calliope\Framework\WebQuery\Condition\FieldCondition', $condition);

		$this->assertEquals('tags', $condition->getField());
	}
}

