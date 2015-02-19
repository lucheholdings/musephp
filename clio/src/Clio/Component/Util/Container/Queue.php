<?php
namespace Clio\Component\Util\Container;

interface Queue
{
	function enqueue($value);

	function dequeue();

	function begin();

	function end();
}

