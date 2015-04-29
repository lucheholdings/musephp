<?php
namespace Clio\Component\Task\Exception;

use Clio\Component\Task\Exception as TaskException;

class NoMoreTaskException extends \RuntimeException implements TaskException
{
}
