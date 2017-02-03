<?php
namespace Clio\Component\Web;

use Clio\Component\Exception\InvalidArgumentException;
/**
 * StatusCodes
 * 
 * @final
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
final class StatusCodes 
{
	const CODE_NOT_FOUND = 404;

	static public $messages = array(
		self::CODE_NOT_FOUND = 'NOT FOUND',
	);

	/**
	 * getMessage 
	 * 
	 * @param mixed $code 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function getMessage($code)
	{
		if(!isset($this->messages[$code])) {
			throw new InvalidArgumentException(sprintf('Message for Code "%s" is not defined.', $code));
		}
		return $this->messages[$code];
	}
}

