<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Tests;

abstract class TestCase extends \PHPUnit_Framework_TestCase 
{
	private $kernel;

	public function setUp()
	{
		$this->kernel = new TestKernel('test', true);
		$this->kernel->boot();
	}
    
    public function getKernel()
    {
        return $this->kernel;
    }

	public function getContainer()
	{
		return $this->getKernel()->getContainer();
	}

	public function get($name)
	{
		return $this->getContainer()->get($name);
	}
}

