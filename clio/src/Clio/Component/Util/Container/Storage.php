<?php
namespace Clio\Component\Util\Container;

interface Storage extends \IteratorAggregate 
{
	const ITERATE_FORWARD = 0;
	const ITERATE_BACKWARD= 1;

	const ITERATE_FIFO    = 0;
	const ITERATE_LIFO    = 8;

	function removeAll();

	function getIterator($mode = null);
}
