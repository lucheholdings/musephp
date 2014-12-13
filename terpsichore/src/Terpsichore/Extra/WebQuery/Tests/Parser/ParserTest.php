<?php
namespace Terpsichore\Extra\WebQuery\Tests\Parser;

use Terpsichore\Extra\WebQuery\Parser\Tokenizer;
use Terpsichore\Extra\WebQuery\Parser\Parser;
use Terpsichore\Extra\WebQuery\Literal\DefaultLiteralSet;
use Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition,
	Terpsichore\Extra\WebQuery\Condition\CollectionalCondition;

/**
 * DefaultExpressionTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
	protected $literals;

	public function setUp()
	{
		$this->literals = new DefaultLiteralSet();
	}

	public function testParseComparison()
	{
		$parser = $this->createParser();

		$cond = $parser->parseComparisonClause($this->createTokenizer('abc'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_EQ, $cond->getOperator());
		$this->assertEquals('abc', $cond->getValue());

		$cond = $parser->parseComparisonClause($this->createTokenizer('=:abc'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_EQ, $cond->getOperator());
		$this->assertEquals('abc', $cond->getValue());

		$cond = $parser->parseComparisonClause($this->createTokenizer('!=:abc'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_NE, $cond->getOperator());
		$this->assertEquals('abc', $cond->getValue());

		$cond = $parser->parseComparisonClause($this->createTokenizer('>:abc'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_GT, $cond->getOperator());
		$this->assertEquals('abc', $cond->getValue());

		$cond = $parser->parseComparisonClause($this->createTokenizer('>=:abc'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_GE, $cond->getOperator());
		$this->assertEquals('abc', $cond->getValue());

		$cond = $parser->parseComparisonClause($this->createTokenizer('<:abc'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_LT, $cond->getOperator());
		$this->assertEquals('abc', $cond->getValue());

		$cond = $parser->parseComparisonClause($this->createTokenizer('<=:abc'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_LE, $cond->getOperator());
		$this->assertEquals('abc', $cond->getValue());

		$cond = $parser->parseComparisonClause($this->createTokenizer('%:abc'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_MATCH, $cond->getOperator());
		$this->assertEquals('abc', $cond->getValue());

		$cond = $parser->parseComparisonClause($this->createTokenizer('=:~'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_EQ, $cond->getOperator());
		$this->assertTrue($cond->isValueNull());

		$cond = $parser->parseComparisonClause($this->createTokenizer('=:*'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_EQ, $cond->getOperator());
		$this->assertTrue($cond->isValueAny());
	}

	public function testParseCollection()
	{
		$parser = $this->createParser();

		$cond = $parser->parseCollectionClause($this->createTokenizer('[abc,!=:def]'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\CollectionalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_OR, $cond->getOperator());
		$this->assertCount(2, $cond->getConditions());

		$cond = $parser->parseCollectionClause($this->createTokenizer('or:[abc,!=:def]'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\CollectionalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_OR, $cond->getOperator());
		$this->assertCount(2, $cond->getConditions());

		$cond = $parser->parseCollectionClause($this->createTokenizer('and:[abc,!=:def]'));
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\CollectionalCondition', $cond);
		$this->assertEquals($cond::OPERATOR_AND, $cond->getOperator());
		$this->assertCount(2, $cond->getConditions());
		
		// check internal condition
		foreach($cond->getConditions() as $inner) {
			if('abc' == $inner->getValue()) {
				$this->assertEquals(ComparisonalCondition::OPERATOR_EQ, $inner->getOperator());
			} else {
				$this->assertEquals(ComparisonalCondition::OPERATOR_NE, $inner->getOperator());
			}
		}
	}

	public function testParse()
	{
		$parser = $this->createParser();

		$cond = $parser->parse('tags', array('a', '!=:b', 'and:[c, d]'));

		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\FieldCondition', $cond);
		$this->assertEquals('tags', $cond->getField());

		$valueCond = $cond->getValueCondition();
		
		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\CollectionalCondition', $valueCond);
		$this->assertEquals($valueCond::OPERATOR_OR, $cond->getValueCondition()->getOperator());


		$values = $cond->getValueCondition()->getConditions();
		$this->assertCount(3, $values);

		$this->assertInstanceOF('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $values[0]);
		$this->assertEquals(ComparisonalCondition::OPERATOR_EQ, $values[0]->getOperator());

		$this->assertInstanceOF('Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition', $values[1]);
		$this->assertEquals(ComparisonalCondition::OPERATOR_NE, $values[1]->getOperator());

		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Condition\CollectionalCondition', $values[2]);
		$this->assertEquals(CollectionalCondition::OPERATOR_AND, $values[2]->getOperator());
	}

	protected function getLiterals()
	{
		return $this->literals;
	}

	protected function createParser()
	{
		return new Parser($this->getLiterals());
	}

	protected function createTokenizer($value)
	{
		return new Tokenizer($value, $this->getLiterals());
	}
}

