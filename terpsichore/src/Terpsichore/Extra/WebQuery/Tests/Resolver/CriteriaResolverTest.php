<?php
namespace Terpsichore\Extra\WebQuery\Tests\Resolver;

use Terpsichore\Extra\WebQuery\Resolver\ConditionResolver;
use Terpsichore\Extra\WebQuery\Expression\Expression;
use Terpsichore\Extra\WebQuery\Comparisons;
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

		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\FieldCondition', $condition);

		$this->assertEquals('tags', $condition->getField());
	}
}

