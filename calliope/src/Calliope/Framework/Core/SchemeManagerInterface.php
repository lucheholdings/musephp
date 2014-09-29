<?php
namespace Calliope\Framework\Core;

/**
 * SchemeManagerInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemeManagerInterface extends SchemeProviderInterface
{
	/**
	 * createModel 
	 * 
	 * @access public
	 * @return void
	 */
	function create($model);

	/**
	 * update 
	 * 
	 * @param mixed $metadata 
	 * @access public
	 * @return void
	 */
	function update($model);

	/**
	 * delete 
	 * 
	 * @param mixed $metadata 
	 * @access public
	 * @return void
	 */
	function delete($model);

	/**
	 * reload 
	 * 
	 * @param mixed $metadata 
	 * @access public
	 * @return void
	 */
	function reload($model);

	/**
	 * schemify 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function schemify($data);

	/**
	 * createModelBuilder 
	 * 
	 * @access public
	 * @return void
	 */
	function createModelBuilder();

	/**
	 * createModel 
	 * 
	 * @access public
	 * @return void
	 */
	function createModel();

	/**
	 * merge 
	 * 
	 * @param $models.. 
	 * @access public
	 * @return void
	 */
	function merge();

	/**
	 * replace 
	 * 
	 * @param $models..
	 * @access public
	 * @return void
	 */
	function replace();
}

