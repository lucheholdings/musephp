<?php
namespace Clio\Bridge\SymfonyComponents\Format\Yaml;

use Clio\Component\Util\Format\Parser as ParserInterface;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Parser implements ParserInterface
{
	private $yaml;

	public function __construct(SymfonyYaml $yaml = null) {
		if(!$yaml) {
			$yaml = new SymfonyYaml();
		}
		$this->yaml = $yaml;
	}

	public function parse($content)
	{
		return $this->getYaml()->parse($content);
	}

	public function isSUpportedFormat($format)
	{
		return 'yaml' == $format;
	}
    
    public function getYaml()
    {
        return $this->yaml;
    }
    
    public function setYaml(SymfonyYaml $yaml)
    {
        $this->yaml = $yaml;
        return $this;
    }
}

