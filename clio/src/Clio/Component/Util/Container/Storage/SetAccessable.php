<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;

interface SetAccessable extends Storage
{
	function insert($value);

	function exists($value);

	function remove($value);
}

