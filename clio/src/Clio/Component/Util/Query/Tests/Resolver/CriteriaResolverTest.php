<?php
namespace Clio\Component\Util\Query\Tests\Resolver;

use Clio\Component\Util\Query\Resolver\ConditionResolver;
use Clio\Component\Util\Query\Expression\Expression;
use Clio\Component\Util\Query\Comparisons;
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

		$this->assertInstanceOf('Clio\Component\Util\Query\Condition\FieldCondition', $condition);

		$this->assertEquals('tags', $condition->getField());
	}
}

