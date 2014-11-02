<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;

interface RandomAccessable extends Storage
{
	function existsAt($key);

	function getAt($key);

	function insertAt($key, $value);

	function removeAt($key);
}
