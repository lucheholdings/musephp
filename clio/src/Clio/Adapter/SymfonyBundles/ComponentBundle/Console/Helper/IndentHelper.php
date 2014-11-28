<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Console\Helper;

use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Output\OutputInterface;
use Clio\Adapter\SymfonyBundles\ComponentBundle\Console\Output\IndentOutputDecorator;

class IndentHelper extends Helper 
{
	private $indentLevel = 0;

	private $indentSize  = 4;

	public function decorate(OutputInterface $output)
	{
		if($output instanceof OutputDecorator) {
			if($output->hasDecorator('Clio\Adapter\SymfonyBundles\ComponentBundle\Console\Output\IndentOutputDecorator')) {
				return $output;
			}
		}

		return new IndentOutputDecorator($output, $this);
	}

	public function format($message)
	{
		return $this->getIndent() . $message;
	}

	public function getName()
	{
		return 'indent';
	}

	public function getIndent()
	{
		return str_repeat(' ', $this->getIndentNum());
	}

	public function getIndentNum()
	{
		return $this->indentLevel * $this->indentSize;
	}

	public function indent()
	{
		$this->indentLevel++;
	}

	public function dedent()
	{
		if($this->indentLevel > 0)
			$this->indentLevel--;
	}

	public function setIndentSize($size)
	{
		$this->indentSize = $size;
	}

	public function getIndentSize()
	{
		return $this->indentSize;
	}

}

