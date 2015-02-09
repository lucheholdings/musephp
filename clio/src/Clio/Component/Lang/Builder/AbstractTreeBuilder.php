<?php
namespace Clio\Component\Lang\Builder;

/**
 * AbstractTopDownBuilder 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractTopDownBuilder
{
	/**
	 * scopeStack 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $scopeStack;

	/**
	 * enterScope 
	 * 
	 * @param mixed $scope 
	 * @access public
	 * @return void
	 */
	public function enterScope($scope)
	{
		if($this->isScopeLocked) {
			throw new \RuntimeException('Scope is locked.');
		}

		$this->getScopeStack()->push($scope);
	}

	/**
	 * leaveScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function leaveScope()
	{
		if($this->isScopeLocked) {
			throw new \RuntimeException('Scope is locked.');
		}

		return $this->getScopeStack()->pop();
	}

	/**
	 * getCurrentScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function getCurrentScope()
	{
		return $this->getScopeStack()->top();
	}

	/**
	 * lockScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function lockScope()
	{
		$this->isScopeLocked = true;
	}

	/**
	 * unlockScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function unlockScope()
	{
		$this->isScopeLocked = false;
	}

	/**
	 * getScopeStack 
	 * 
	 * @access public
	 * @return void
	 */
	public function getScopeStack()
	{
		return $this->scopeStack;
	}
}

