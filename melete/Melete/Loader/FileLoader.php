<?php
namespace Melete\Loader;

use Symfony\Component\Config\FileLocatorInterface;

class FileLoader extends ArrayLoader
{
	private $locator;

	private $parser;

	public function __construct(FileLocatorInterface $locator)
	{
		$this->locator = $locator;
	}

	public function load($file)
	{
		$path = $this->locator->locate($file);

		$content = $this->loadFile($path);

		return parent::load($content);
	}

	public function loadFile($file)
	{
		if (!stream_is_local($file)) {
            throw new \InvalidArgumentException(sprintf('This is not a local file "%s".', $file));
        }

        if (!file_exists($file)) {
            throw new \InvalidArgumentException(sprintf('The service file "%s" is not valid.', $file));
        }

		$content = file_get_contents($file);
		return $this->parseFileContent($content);
	}

	protected function parseFileContent($content)
	{
		$parser = $this->getParser();

		if(!$parser) {
			throw new \RuntimeException('Parser is not intialized.');
		}

		return $parser->parse($content);
	}
    
    public function getLocator()
    {
        return $this->locator;
    }
    
    public function setLocator($locator)
    {
        $this->locator = $locator;
        return $this;
    }

    public function getParser()
    {
        return $this->parser;
    }
    
    public function setParser($parser)
    {
        $this->parser = $parser;
        return $this;
    }
}

