<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;

interface SequencialAccessable extends Storage
{
	function insertBegin($value);

	function insertEnd($value);

	function begin();

	function end();

	function removeBegin();

	function removeEnd();
}
