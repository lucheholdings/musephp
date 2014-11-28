<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Console\Output;

use Symfony\Component\Console\Output\OutputInterface;
use Clio\Adapter\SymfonyBundles\ComponentBundle\Console\Helper\IndentHelper;

class IndentOutputDecorator extends OutputDecorator
{
	private $indentHelper;

	private $nextNewLine;

	public function __construct(OutputInterface $output, IndentHelper $helper = null)
	{
		parent::__construct($output);
		if(!$helper) {
			$helper = new IndentHelper();
		}
		$this->indentHelper = $helper;

		$this->nextNewLine = true;
	}

    public function write($messages, $newline = false, $type = self::OUTPUT_NORMAL)
	{
		$messages = (array)$messages;
	
		foreach($messages as &$message) {
			$message = $this->indentMessage($message, $this->nextNewLine);
		}

		$this->getOutput()->write($messages, $newline, $type);

		if($newline)
			$this->nextNewLine = true;
	}

    public function writeln($messages, $type = self::OUTPUT_NORMAL)
	{
		$messages = (array)$messages;

		foreach($messages as &$message) {
			$message = $this->indentMessage($message, $this->nextNewLine);
			$this->nextNewLine = true;
		}
		$this->getOutput()->writeln($messages, $type);
	}
    
    public function getIndentHelper()
    {
        return $this->indentHelper;
    }
    
    public function setIndentHelper(IndentHelper $indentHelper)
    {
        $this->indentHelper = $indentHelper;
        return $this;
    }

	public function indentMessage($message, $beginWithIndent)
	{
		$replaced = preg_replace("/\n([^$])/", "\n" . $this->getIndentHelper()->getIndent() . '\1', $message);
		if($replaced) 
			$message = $replaced;

		return $beginWithIndent ? $this->getIndentHelper()->getIndent() . $message : $message;
	}
}

