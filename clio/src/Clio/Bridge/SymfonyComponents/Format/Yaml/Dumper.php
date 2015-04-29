<?php
namespace Clio\Bridge\SymfonyComponents\Format\Yaml;

use Clio\Component\Format\Dumper as DumperInterface;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Dumper implements DumperInterface
{
	private $yaml;

	public function __construct(SymfonyYaml $yaml = null) {
		if(!$yaml) {
			$yaml = new SymfonyYaml();
		}
		$this->yaml = $yaml;
	}

	public function dump($content)
	{
		return $this->getYaml()->dump($content);
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

