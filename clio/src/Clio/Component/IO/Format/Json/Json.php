<?php
namespace Clio\Component\IO\Format\Json;

use Clio\Component\IO\Format;

/**
 * Json 
 * 
 * @uses Format
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Json extends Format 
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct(new Parser(), new Dumper());
	}
}

