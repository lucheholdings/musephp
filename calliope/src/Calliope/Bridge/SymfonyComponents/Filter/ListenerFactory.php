<?php
namespace Calliope\Bridge\SymfonyComponents\Filter;

/**
 * ListenerFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface ListenerFactory
{
	/**
	 * __construct 
	 *   Constructor of the ListenerFactory
	 *   Any arguments should not be REQUIRED to create from FactoryFactory 
	 * 
	 * @access protected
	 * @return void
	 */
	function __construct();

	/**
	 * createFilterListener 
	 *   Create new FilterListener with overwrite Options 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createFilterListener(array $options);

	/**
	 * setDefaultOptions 
	 *   Set DefaultOptions
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function setDefaultOptions(array $options);
}
