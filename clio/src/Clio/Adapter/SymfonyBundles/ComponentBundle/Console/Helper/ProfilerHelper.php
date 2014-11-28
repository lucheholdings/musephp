<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Console\Helper;

use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class ProfilerHelper extends Helper 
{
	const STOPWATCH_NAME = 'console.profiler';
	private $stopwatch;

	public function __construct()
	{
		$this->stopwatch = new Stopwatch();
		$this->stopwatch->start(self::STOPWATCH_NAME);
	}

	public function __destruct()
	{
		$end = $this->stopwatch->stop(self::STOPWATCH_NAME);
	}

	public function renderCurrentProfile(OutputInterface $output)
	{
		$now = $this->stopwatch->lap(self::STOPWATCH_NAME); 
		$output->writeln('Time      : ' . number_format($now->getDuration()) . ' MiS');
		$output->writeln('Mem. Max  : ' . number_format($now->getMemory()) . ' Bytes');
	}

	public function getName()
	{
		return 'profiler';
	}
}

