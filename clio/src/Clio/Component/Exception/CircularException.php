<?php
namespace Clio\Component\Exception;

class CircularException extends Exception 
{
	const DEFAULT_MESSAGE = 'Circular Reference';
}

