<?php
namespace Clio\Extra\Loader;

use Clio\Component\Files\Format;

class FormatLoader implements Loader
{
	public function __construct(Format $format, Parser $parser)
	{
		$this->format = $format;
		$this->parser = $parser;
	}

	public function load($resource)
	{
		if(is_string($resource)) {
			// If the string without breaks, then guess the resource is a filepath.
			// Try to load the file, and if the file is loadable replace the resource with loaded.
			if(false === strpos("\n", $resource)) {
				$imported = $this->loadFile($resource);
				if($imported) {
					$resource = $imported;
				}
			}
		}

		// Parse the resource with formatParser
		$data = $format->getParser()->parse($resource);

		// Convert data to shared schema array,object
		return $this->getParser()->parse($data);
	}
}

