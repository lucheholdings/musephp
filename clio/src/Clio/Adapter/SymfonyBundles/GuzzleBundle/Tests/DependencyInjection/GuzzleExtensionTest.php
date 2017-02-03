<?php
/****
 *
 * Description:
 *      
 * $Id$
 * $Date$
 * $Rev$
 * $Author$
 * 
 *  This file is part of the $Project$ package.
 *
 * $Copyrights$
 *
 ****/
namespace Clio\Adapter\SymfonyBundles\GuzzleBundle\Tests\DependencyInjection;

use Clio\Adapter\SymfonyBundles\GuzzleBundle\DependencyInjection\ClioGuzzleExtension;
use Clio\Adapter\SymfonyBundles\GuzzleBundle\Tests\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class ClioGuzzleExtensionTest extends TestCase
{
	public function testLoadEmptyConfiguration()
	{
		$container = $this->createContainer();
		$container->registerExtension(new ClioGuzzleExtension());
		$container->loadFromExtension('clio_guzzle', array());
		$this->compileContainer($container);
	}


	/**
	 * testLoadFullConfiguration 
	 * 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 *
	 * @dataProvider getFormats
	 */
	public function testLoadFullConfiguration($format)
	{
		$container = $this->createContainer();
		$container->registerExtension(new ClioGuzzleExtension());
	}

	/**
	 * getFormats 
	 *   Test DataProvider 
	 * @access public
	 * @return void
	 */
	public function getFormats()
	{
		return array(
			array('yml')
		);
	}

	private function createContainer()
	{
		// Default Setting
		$container = new ContainerBuilder(new ParameterBag(array(
			'kernel.cache_dir'  => __DIR__,
			'kernel.charset'    => 'UTF-8',
			'kernel.debug'      => false,
		)));

		return $container;
	}

	private function compileContainer(ContainerBuilder $container)
	{
		$container->compile();
	}

	private function loadFromFile(ContainerBuilder $container, $file, $format)
	{
		$locator = new FileLocator(__DIR__.'/Fixtures/'.$format);
		switch($format) {
		case 'yml':
			$loader = new YamlFileLoader($container, $locator);
			break;
		default:
			throw new \InvalidArgumentException('Unsupported Format : '.$format);
		}

		$loader->load($file.'.'.$format);
	}
}
