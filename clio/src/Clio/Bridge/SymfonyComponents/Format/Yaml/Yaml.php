<?php
namespace Clio\Bridge\SymfonyComponents\Format\Yaml;

use Clio\Component\Format\StandardFormat;
use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yaml extends StandardFormat
{
	private $yaml;

	public function __construct()
	{
		$this->yaml = new SymfonyYaml();
		parent::__construct(
			'yaml',
			new Parser($this->yaml),
			new Dumper($this->yaml),
			array(
				'yml',
				'yaml'
			),
			array(
				'text/yaml',
				'text/x-yaml',
				'application/yaml',
				'application/x-yaml',
			)
		);
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

