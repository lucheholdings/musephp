<?php
namespace Clio\Component\Lang\Builder;

/**
 * TopDownArrayBuilder 
 * 
 * @uses AbstractTopDownBuilder
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TopDownArrayBuilder extends AbstractTopDownBuilder
{
	/**
	 * {@inheritdoc}
	 */
	public function __construct()
	{
		$this->current = new Collection();
	}

	/**
	 * {@inheritdoc}
	 */
	public function enterScope($scope)
	{
		$current = $this->getCurrentScope();
		$current[$scope] = new Collection();

		$current = $current[$scope];
		
		parent::enterScope($current);
	}

	/**
	 * {@inheritdoc}
	 */
	public function setProperty($key, $value)
	{
		$current = $this->getCurrentScope();
		$current[$key] = $value;
	}

	/**
	 * {@inheritdoc}
	 */
	public function build()
	{
		$root = $this->getScopeStack()->top();

		// Recursive conversion from Collection to array
		$func = function($v) use ($func){
			return ($v instanceof Collection) ? $v->all($func) : $v;
		};

		return $root->all($func);
	}
}

