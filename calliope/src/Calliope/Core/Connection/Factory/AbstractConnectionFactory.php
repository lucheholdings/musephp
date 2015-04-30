<?php
namespace Calliope\Core\Connection\Factory;

use Clio\Component\Pattern\Factory;
use Calliope\Core\Connection\Factory as ConnectionFactory;
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
abstract class AbstractConnectionFactory extends Factory\AbstractFactory implements ConnectionFactory 
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
		return $this->doCreateConnection(Factory\Util::shiftArg($args, 'connect_to'), Factory\Util::shiftArg($arg, 'options'));
	}

    /**
     * doCreateConnection 
     * 
     * @param mixed $connectTo 
     * @param array $options 
     * @access protected
     * @return void
     */
    abstract protected function doCreateConnection($connectTo, array $options = array());

    /**
     * createConnection 
     * 
     * @param mixed $connectTo 
     * @param array $options 
     * @access public
     * @return void
     */
    public function createConnection($connectTo, array $options = array())
    {
        return $this->create($connectTo, $options);
    }
}

