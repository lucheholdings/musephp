<?php
namespace Melete\JIS;

use Melete\Loader\CsvFileLoader;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\FileLocator;

use Melete\CodeStandard;
use Melete\Content;

class JisX0401 extends CodeStandard 
{
	static public function createDefault()
	{
		$definition = new static();
		$headers = array(
			'code',
			'name',
			'kana'
		);

		$loader = new CsvFileLoader(
			new FileLocator(__DIR__ . '/../Resources'),
			$headers
		);
		$loader->setDefinition($definition);

		$data = $loader->load('jis/jis_x_0401.csv');

		foreach($data as $code => $values) {

			$definition->setByCode($code, new Content($values));
		}

		return $definition;
	}

	public function __construct()
	{
		parent::__construct('jis_x_0401');
	}

	public function getConfigTree()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('jis_x_0401');

		$rootNode
			->useAttributeAsKey('code', false)
			->prototype('array')
				->children()
					->scalarNode('code')->isRequired()->end()
					->scalarNode('name')->isRequired()->end()
					->scalarNode('kana')->defaultNull()->end()
				->end()
			->end()
		;

		return $treeBuilder;
	}
}

