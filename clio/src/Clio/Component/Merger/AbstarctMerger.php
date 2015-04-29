<?php
namespace Clio\Component\Merger;

/**
 * AbstractMerger 
 * 
 * @uses Merger
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMerger implements Merger
{
	/**
	 * merge 
	 * 
	 * @param mixed $origin
	 * @param mixed.. merge resources
	 * @access public
	 * @return void
	 */
	public function merge($origin)
	{
		$resources = func_get_args();
		array_shift($resources);
		
		while(0 < count($resources)) {
			$origin = $this->doMerge($origin, array_shift($resources));
		}

		return $origin;
	}

	/**
	 * doMerge 
	 *   Merge exact 2 data.
	 * 
	 * @param mixed $origin 
	 * @param mixed $newData 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doMerge($origin, $newData);
}

