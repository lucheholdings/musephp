<?php
namespace Clio\Component\Container\Storage;

interface Storage extends \IteratorAggregate 
{
	const ITERATE_FORWARD = 0;
	const ITERATE_BACKWARD= 1;

	const ITERATE_FIFO    = 0;
	const ITERATE_LIFO    = 8;

    /**
     * removeAll 
     * 
     * @access public
     * @return void
     */
	function removeAll();

    /**
     * getIterator 
     * 
     * @param mixed $mode 
     * @access public
     * @return void
     */
	function getIterator($mode = null);
}
