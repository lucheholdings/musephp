<?php
namespace Melete\Loader;

use Symfony\Component\Yaml\YamlParser;

class YamlFileLoader extends FileLoader 
{
	protected function parseContent($content)
	{
		$parser = $this->getParser();
		if(!$parser) {
			$this->setParser($parser = new YamlParser());
		}

		return parent::parseContent($content);
	}
}

