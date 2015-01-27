<?php
namespace Clio\Component\Util\Notify;

/**
 * NullNotifier 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NulllNotifier implements Notifier
{
	/**
	 * notify 
	 * 
	 * @param mixed $notify 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function notify($notify, array $args = array())
	{
		// do nothing
		return null;
	}
}

