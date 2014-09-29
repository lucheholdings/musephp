<?php
namespace Calliope\Framework\Core\Connection\Paging\Page;

use Clio\Component\Util\Container\Collection;

/**
 * ConnectionPageInterface 
 *   ConnectionPage extends Collection
 * 
 * @uses CollectionInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ConnectionPageInterface extends Collection
{
	/**
	 * getPager 
	 * 
	 * @access public
	 * @return void
	 */
	function getPager();

	/**
	 * getConnection 
	 * 
	 * @access public
	 * @return void
	 */
	function getConnection();
}

