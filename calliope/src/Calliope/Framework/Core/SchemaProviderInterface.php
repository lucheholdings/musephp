<?php
namespace Calliope\Framework\Core;


/**
 * SchemaProviderInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemaProviderInterface
{
	/**
	 * findBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null);

	/**
	 * findOneBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @access public
	 * @return void
	 */
	function findOneBy(array $criteria, array $orderBy = array());

	/**
	 * countBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	function countBy(array $criteria);
}
