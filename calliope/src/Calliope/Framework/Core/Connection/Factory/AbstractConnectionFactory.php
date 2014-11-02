<?php
namespace Calliope\Framework\Core\Connection\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
/**
 * AbstractConnectionFactory 
 * 
 * @uses ConnectionFactoryInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractConnectionFactory extends AbstractFactory implements ConnectionFactoryInterface
{
	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args)
	{
		return $this->createConnection($args);
	}
}

