<?php
namespace Clio\Adapter\Doctrine\Util;

use Clio\Component\Util\Hash\HashGenerateStrategyInterface,
	Clio\Component\Util\Hash\Strategy\PseudoHashGenerateStrategy
;
/**
 * HashIdUtil 
 *   HashGenerator for Doctrine HashIdUtil. 
 * @singleton
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HashIdUtil 
{
	static $generators = array();

	static public function setGenerator($class, HashGenerateStrategyInterface $generator)
	{
		static::$generators[$class] = $generator;
	}

	static public function getGeneratorFor($entity)
	{
		$class = get_class($entity);

		if(isset(static::$generators[$class])) {
			return static::$generators[$class];
		}

		return static::$generators[$class] = static::createDefaultGenerator();
	}

	static public function createDefaultGenerator()
	{
		return new PseudoHashGenerateStrategy(8);
	}
}

