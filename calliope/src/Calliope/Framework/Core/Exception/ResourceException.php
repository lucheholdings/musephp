<?php
namespace Calliope\Framework\Core\Exception;

/**
 * ResourceException 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ResourceException extends \Exception 
{
	public function __construct($message, $code = 0, $prev = null)
	{
		if(is_array($message)) {
			$message = $this->formatMessage($message);
		}
		parent::__construct($message, $code, $prev);
	}

	/**
	 * formatMessage 
	 * 
	 * @param array $params 
	 * @access protected
	 * @return void
	 */
	protected function formatMessage(array $params = array())
	{
		return 'Resource Exception';
	}
}

