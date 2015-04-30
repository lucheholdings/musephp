<?php
namespace Clio\Component\Pattern\Factory\Exception;

use Clio\Component\Pattern\Factory\Exception;

/**
 * FailedException 
 *   Failed to factory object 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FailedException extends \RuntimeException implements Exception 
{
    const DEFAULT_MESSAGE = 'Failed on factory object.';

    /**
     * {@inheritdoc}
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null, )
    {
        if(empty($message)) {
            $message = static::DEFAULT_MESSAGE;
        }
        parent::__construct($message, $code, $previous);
    }
}

