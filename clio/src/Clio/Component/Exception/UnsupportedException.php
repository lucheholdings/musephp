<?php
namespace Clio\Component\Exception;

class UnsupportedException extends \RuntimeException implements Throwable 
{
	const DEFAULT_MESSAGE = 'Unsupported';
}

