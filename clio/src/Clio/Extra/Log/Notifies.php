<?php
namespace Clio\Extra\Log;

/**
 * Notifies 
 * 
 * @final
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
final class Notifies
{
    const Emergency       = 'logger.log_emergency';
    const Alert           = 'logger.log_alert';
    const Critical        = 'logger.log_critical';
    const Error           = 'logger.log_error';
    const Warning         = 'logger.log_warning';
    const Notice          = 'logger.log_notice';
    const Info            = 'logger.log_info';
    const Debug           = 'logger.log_debug';

	// Notify options 
	const OPTION_LOG_LEVEL = 'log_level';
	const OPTION_MESSAGE   = 'message';
	const OPTION_CONTEXT   = 'context';
}

