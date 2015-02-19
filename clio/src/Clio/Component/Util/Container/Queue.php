<?php
namespace Clio\Component\Util\Container;

interface Queue extends \Countable, \Serializable, \IteratorAggregate
{
	function enqueue($value);

	function dequeue();

	function begin();

	function end();
}

