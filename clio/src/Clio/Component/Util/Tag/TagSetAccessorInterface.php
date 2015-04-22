<?php
namespace Clio\Component\Util\Tag;

/**
 * TagSetAccessorInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TagSetAccessorInterface 
{
	/**
	 * createTag 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function createTag($name);

    /**
     * add 
     * 
     * @param TagSet $container 
     * @param mixed $name 
     * @access public
     * @return void
     */
	function add(TagSet $container, $name);

    /**
     * has 
     * 
     * @param TagSet $container 
     * @param mixed $name 
     * @access public
     * @return void
     */
	function has(TagSet $container, $name);
	
    /**
     * remove 
     * 
     * @param TagSet $container 
     * @param mixed $name 
     * @access public
     * @return void
     */
	function remove(TagSet $container, $name);

    /**
     * removeAll 
     * 
     * @param TagSet $container 
     * @access public
     * @return void
     */
	function removeAll(TagSet $container);

    /**
     * replace 
     * 
     * @param TagSet $container 
     * @param array $names 
     * @access public
     * @return void
     */
	function replace(TagSet $container, array $names);

    /**
     * getNames 
     * 
     * @param TagSet $container 
     * @access public
     * @return void
     */
	function getNames(TagSet $container);
}

