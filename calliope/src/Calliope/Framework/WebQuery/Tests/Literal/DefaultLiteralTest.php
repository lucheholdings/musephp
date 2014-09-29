<?php
namespace Calliope\Framework\WebQuery\Tests\Literal;

use Calliope\Framework\WebQuery\Literal\DefaultLiteralSet;
/**
 * LiteralTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DefaultLiteralTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testLiterals 
	 * 
	 * @access public
	 * @return void
	 */
	public function testLiterals()
	{
		$literals = new DefaultLiteralSet();
		
		// Equal
		$this->assertEquals(
			$literals::LT_OPERATOR_EQ . $literals::LT_OPERATOR_END,
			$literals->operatorEq()
		);

		// Ne
		$this->assertEquals(
			$literals::LT_OPERATOR_NE . $literals::LT_OPERATOR_END,
			$literals->operatorNe()
		);

		// 
		$this->assertEquals(
			$literals::LT_OPERATOR_GT . $literals::LT_OPERATOR_END,
			$literals->operatorGt()
		);

		// 
		$this->assertEquals(
			$literals::LT_OPERATOR_GE . $literals::LT_OPERATOR_END,
			$literals->operatorGe()
		);

		// 
		$this->assertEquals(
			$literals::LT_OPERATOR_LT . $literals::LT_OPERATOR_END,
			$literals->operatorLt()
		);

		// 
		$this->assertEquals(
			$literals::LT_OPERATOR_LE . $literals::LT_OPERATOR_END,
			$literals->operatorLe()
		);

		// 
		$this->assertEquals(
			$literals::LT_OPERATOR_MATCH . $literals::LT_OPERATOR_END,
			$literals->operatorMatch()
		);

		// 
		$this->assertEquals(
			$literals::LT_VALUE_ANY,
			$literals->valueAny()
		);

		// 
		$this->assertEquals(
			$literals::LT_VALUE_NULL,
			$literals->valueNull()
		);

		// 
		$this->assertEquals(
			$literals::LT_COLLECTION_OPEN,
			$literals->collectionOpen()
		);

		// 
		$this->assertEquals(
			$literals::LT_COLLECTION_CLOSE,
			$literals->collectionClose()
		);

		// 
		$this->assertEquals(
			$literals::LT_COLLECTION_SEPARATOR,
			$literals->collectionSeparator()
		);
	}


	public function testIsEscapeLiteral()
	{
		$literals = new DefaultLiteralSet();

		$this->assertTrue($literals->isEscapeLiteral('\\'));
		$this->assertFalse($literals->isEscapeLiteral('/'));
		$this->assertFalse($literals->isEscapeLiteral('a'));
	}
}


