<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Console\Helper;

use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Output\OutputInterface;

class DisplayHelper extends Helper 
{
	private $padding = 0;

	private $displayWidth;

    public function getDisplayWidth()
    {
		if(!$this->displayWidth) {
			$this->displayWidth = exec('tput cols');
		}
        return $this->displayWidth;
    }

	public function setDisplayWidth($width)
	{
		$this->displayWidth = $width;
	}

	public function getWidth()
	{
		return $this->getDisplayWidth() - (2 * $this->getPadding());
	}
    
	public function horizontalBorder(OutputInterface $output, $char = '-')
	{
		$output->writeln(str_repeat($char, $this->getWidth()));
	}

	public function getName()
	{
		return 'display';
	}
    
    public function getPadding()
    {
        return $this->padding;
    }
    
    public function setPadding($padding)
    {
        $this->padding = $padding;
        return $this;
    }

	public function newline(OutputInterface $output)
	{
		$output->write('', true);
	}
}

