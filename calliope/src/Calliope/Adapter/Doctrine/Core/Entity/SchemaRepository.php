<?php
namespace Calliope\Adapter\Doctrine\Core\Entity;

/**
 * SchemaRepository 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemaRepository 
{
	/**
	 * countBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	function countBy(array $criteria);

	/**
	 * createQueryBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	function createQueryBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null);

}

