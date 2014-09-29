<?php
namespace Melete\JIS;

use Melete\Loader\CsvFileLoader;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\FileLocator;

use Melete\CodeStandard;
use Melete\Content;

class JisX0402 extends CodeStandard 
{
	static public function createDefault()
	{
		$definition = new static();
		$headers = array(
			'code',
			'pref_code',
			'pref',
			'name',
			'kana'
		);

		$loader = new CsvFileLoader(
			new FileLocator(__DIR__ . '/../Resources'),
			$headers
		);
		$loader->setDefinition($definition);

		$data = $loader->load('jis/jis_x_0402.csv');

		foreach($data as $code => $values) {

			$definition->setByCode($code, new Content($values));
		}

		return $definition;
	}

	public function __construct()
	{
		parent::__construct('jis_x_0402');
	}

	public function getConfigTree()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('jis_x_0402');

		$rootNode
			->useAttributeAsKey('code', false)
			->prototype('array')
				->children()
					->scalarNode('code')->isRequired()->end()
					->scalarNode('name')->isRequired()->end()
					->scalarNode('pref_code')->defaultNull()->end()
					->scalarNode('pref')->defaultNull()->end()
					->scalarNode('kana')->defaultNull()->end()
				->end()
			->end()
		;

		return $treeBuilder;
	}
}

