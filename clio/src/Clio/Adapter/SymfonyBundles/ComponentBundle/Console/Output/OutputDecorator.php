<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Console\Output;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;

class OutputDecorator implements OutputInterface
{
	private $output;
	
	public function __construct(OutputInterface $output)
	{
		$this->output = $output;
	}

    public function write($messages, $newline = false, $type = self::OUTPUT_NORMAL)
	{
		$this->getOutput()->write($messages, $newline, $type);
	}

    public function writeln($messages, $type = self::OUTPUT_NORMAL)
	{
		$this->getOutput()->writeln($messages, $type);
	}

    public function setVerbosity($level)
	{
		$this->getOutput()->setVerbosity($level);
	}

    public function getVerbosity()
	{
		return $this->getOutput()->getVerbosity();
	}

    public function setDecorated($decorated)
	{
		$this->getOutput()->setDecorated($decorated);
	}

    public function isDecorated()
	{
		return $this->getOutput()->isDecorated();
	}

    public function setFormatter(OutputFormatterInterface $formatter)
	{
		$this->getOutput()->setFormatter($formatter);
	}

    public function getFormatter()
	{
		return $this->getOutput()->getFormatter();
	}
    
    public function getOutput()
    {
        return $this->output;
    }
    
    public function setOutput(OutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }

	public function hasDecorator($decoratorClass)
	{
		if($this instanceof $decoratorClass) {
			return true;
		}
		if($this->getOutput() instanceof OutputDecorator) {
			return $this->getOutput()->hasDecorator($decoratorClass);
		}

		return false;
	}

	public function getDecorator($decoratorClass)
	{
		if($this instanceof $decoratorClass) {
			return $this;
		}
		if($this->getOutput() instanceof OutputDecorator) {
			return $this->getOutput()->getDecorator($decoratorClass);
		}

		throw new \RuntimeException(sprintf('Output is not decorated by OutputDecorator "%s"', $decoratorClass));
	}
}

