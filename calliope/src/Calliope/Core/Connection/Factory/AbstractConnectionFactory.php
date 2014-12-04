<?php
namespace Calliope\Core\Connection\Factory;

use Clio\Component\Pattern\Factory\AbstractFactory;
use Calliope\Core\Connection\Factory;
/**
 * AbstractConnectionFactory 
 * 
 * @uses Factory 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractConnectionFactory extends AbstractFactory implements Factory 
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

