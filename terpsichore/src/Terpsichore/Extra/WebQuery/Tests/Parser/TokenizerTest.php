<?php
namespace Terpsichore\Extra\WebQuery\Tests\Parser;

use Terpsichore\Extra\WebQuery\Parser\Tokenizer;
use Terpsichore\Extra\WebQuery\Literal\DefaultLiteralSet;

class TokenizerTest extends \PHPUnit_Framework_TestCase
{
	protected $literals;
	
	public function setUp()
	{
		$this->literals = new DefaultLiteralSet();
	}

	public function testMatch()
	{
		$tokenizer = $this->createTokenizer('=:!=:>:>=:<:<=:%:or:and:[]');

		// EQ
		$lit = $tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_EQ);
		$this->assertEquals('=:', $lit);

		// NE
		$lit = $tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_NE);
		$this->assertEquals('!=:', $lit);

		// 
		$lit = $tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_GT);
		$this->assertEquals('>:', $lit);

		// 
		$lit = $tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_GE);
		$this->assertEquals('>=:', $lit);

		// 
		$lit = $tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_LT);
		$this->assertEquals('<:', $lit);

		// 
		$lit = $tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_LE);
		$this->assertEquals('<=:', $lit);

		// 
		$lit = $tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_MATCH);
		$this->assertEquals('%:', $lit);

		// 
		$lit = $tokenizer->match($tokenizer::T_LOGIC_OPERATOR_OR);
		$this->assertEquals('or:', $lit);

		//
		$lit = $tokenizer->match($tokenizer::T_LOGIC_OPERATOR_AND);
		$this->assertEquals('and:', $lit);
		
		//
		$lit = $tokenizer->match($tokenizer::T_COLLECTION_OPEN);
		$this->assertEquals('[', $lit);

		//
		$lit = $tokenizer->match($tokenizer::T_COLLECTION_CLOSE);
		$this->assertEquals(']', $lit);
	}

	public function testIsNext()
	{
		$tokenizer = $this->createTokenizer('=:!=:>:>=:<:<=:%:or:and:[]');

		// EQ
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_EQ));
		$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_EQ);

		// NE
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_NE));
		$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_NE);

		// GT 
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_GT));
		$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_GT);

		// GE 
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_GE));
		$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_GE);

		// LT
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_LT));
		$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_LT);

		// LE
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_LE));
		$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_LE);

		// MATCH
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_MATCH));
		$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_MATCH);

		// OR
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_LOGIC_OPERATOR_OR));
		$tokenizer->match($tokenizer::T_LOGIC_OPERATOR_OR);

		// AND
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_LOGIC_OPERATOR_AND));
		$tokenizer->match($tokenizer::T_LOGIC_OPERATOR_AND);

		// Collection Open
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COLLECTION_OPEN));
		$tokenizer->match($tokenizer::T_COLLECTION_OPEN);

		// Collection Close
		$this->assertTrue($tokenizer->isNextToken($tokenizer::T_COLLECTION_CLOSE));
		$tokenizer->match($tokenizer::T_COLLECTION_CLOSE);
	}

	public function testRemain()
	{
		$tokenizer = $this->createTokenizer('or:[abc,def]');

		$tokenizer->match($tokenizer::T_LOGIC_OPERATOR_OR);

		$remain = $tokenizer->remain();

		$this->assertEquals('[abc,def]', $remain);
	}

	public function testUntil()
	{
		$tokenizer = $this->createTokenizer('or:[abc,def]');

		$tokenizer->match($tokenizer::T_LOGIC_OPERATOR_OR);
		$tokenizer->match($tokenizer::T_COLLECTION_OPEN);

		$next = $tokenizer->until($tokenizer::T_COLLECTION_SEPARATOR, $tokenizer::T_COLLECTION_CLOSE);
		$this->assertEquals('abc', $next);

		$tokenizer->match($tokenizer::T_COLLECTION_SEPARATOR);

		$next = $tokenizer->until($tokenizer::T_COLLECTION_SEPARATOR, $tokenizer::T_COLLECTION_CLOSE);
		$this->assertEquals('def', $next);

		$tokenizer->match($tokenizer::T_COLLECTION_CLOSE);
	}

	public function testSubTokenizer()
	{
		$tokenizer = $this->createTokenizer('[abc,def]');

		$tokenizer->match($tokenizer::T_COLLECTION_OPEN);

		$inner = $tokenizer->createTokenizer($tokenizer->until($tokenizer::T_COLLECTION_CLOSE));

		$this->assertInstanceOf('Terpsichore\Extra\WebQuery\Parser\Tokenizer', $inner);
		$this->assertEquals('abc,def', $inner->getValue());
	}

	/**
	 * getLiterals
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getLiterals()
	{
		return $this->literals;
	}

	/**
	 * createTokenizer 
	 * 
	 * @param mixed $value 
	 * @access protected
	 * @return void
	 */
	protected function createTokenizer($value)
	{
		return new Tokenizer($value, $this->getLiterals());
	}
}

