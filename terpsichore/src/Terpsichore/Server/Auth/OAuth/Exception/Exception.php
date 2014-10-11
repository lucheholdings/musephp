<?php
namespace Terpsichore\Server\Auth\OAuth\Exception;

/**
 * Exception 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Exception extends \Exception
{
	const ERR_MESSAGE = 'invalid';

	/**
	 * __construct 
	 * 
	 * @param mixed $description 
	 * @param int $code 
	 * @param mixed $prev 
	 * @access public
	 * @return void
	 */
	public function __construct($description, $code = 0, $prev = null)
	{
		parent::__construct(static::ERR_MESSAGE, $code, $prev);
		$this->description = $description;
	}
}
