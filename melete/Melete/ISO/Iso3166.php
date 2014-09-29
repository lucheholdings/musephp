<?php
namespace Melete\ISO;

use Melete\Loader\CsvFileLoader;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\FileLocator;

use Melete\MultiCodeStandard,
	Melete\Content;

class Iso3166 extends MultiCodeStandard 
{
	static public function createDefault()
	{
		$definition = new static();
		$headers = array(
			'name',
			'alpha2',
			'alpha3',
			'numeric',
			'iso_3166_2',
		);

		$loader = new CsvFileLoader(
			new FileLocator(__DIR__ . '/../Resources'),
			$headers
		);
		$loader->setDefinition($definition);

		$data = $loader->load('iso/iso_3166.csv');

		foreach($data as $code => $values) {
			$definition->setByCode($code, new Content($values));
		}

		return $definition;
	}

	public function __construct($indexCode = 'numeric')
	{
		parent::__construct('iso_3166', $indexCode);
		
		$this
			->addCodeType('alpha2')
			->addCodeType('alpha3')
		;
	}

	public function getConfigTree()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('codes');

		$rootNode
			->useAttributeAsKey('numeric', false)
			->prototype('array')
				->children()
					->scalarNode('name')->isRequired()->end()
					->scalarNode('alpha2')->isRequired()->end()
					->scalarNode('alpha3')->isRequired()->end()
					->scalarNode('numeric')->isRequired()->end()
					->scalarNode('iso_3166_2')->isRequired()->end()
				->end()
			->end()
		;

		return $treeBuilder;
	}

	public function getByAlpha2($code)
	{
		return $this->getByCode($code, 'alpha2');
	}

	public function getByAlpha3($code)
	{
		return $this->getByCode($code, 'alpha3');
	}

	public function getContentsByAlpha2()
	{
		return $this->getContents('alpha2');
	}

	public function getContentsByAlpha3()
	{
		return $this->getContents('alpha3');
	}
}

