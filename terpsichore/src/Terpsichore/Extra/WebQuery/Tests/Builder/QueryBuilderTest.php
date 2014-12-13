<?php
namespace Terpsichore\Extra\WebQuery\Tests\Builder;

use Terpsichore\Extra\WebQuery\Builder\QueryBuilder;
use Terpsichore\Extra\WebQuery\Literal\DefaultLiteralSet;

use Terpsichore\Extra\WebQuery\Condition\FieldCondition;

class QueryBuilderTest extends \PHPUnit_Framework_TestCase
{
	
	public function testBuildConditionQuery()
	{
		$builder = $this->createBuilder();

		$query = $builder->buildQuery($builder->expr()->orx(
			$builder->expr()->eq('abc'),
			$builder->expr()->ne('def'),
			$builder->expr()->in(array('foo', 'bar'))
		));
		
		$this->assertEquals('[=:abc,!=:def,[=:foo,=:bar]]', $query);
	}

	public function testBuild()
	{
		$builder = $this->createBuilder();

		$builder->add(new FieldCondition('tags', $builder->expr()->eq('foo')));

		$criteria = $builder->build();

		$this->assertArrayHasKey('tags', $criteria);
		$this->assertEquals('=:foo', $criteria['tags']);
	}

	protected function getLiterals()
	{
		return new DefaultLiteralSet();
	}

	protected function createBuilder()
	{
		return new QueryBuilder($this->getLiterals());
	}
}

