<?php
namespace Clio\Component\Format\Json;

use Clio\Component\Format\StandardFormat;

/**
 * Json 
 * 
 * @uses Format
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Json extends StandardFormat 
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct(
			'json',
			new Parser(), 
			new Dumper(),
			'json',
			'application/json'
		);
	}
}

