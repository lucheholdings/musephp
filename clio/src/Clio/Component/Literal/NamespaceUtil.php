<?php
namespace Clio\Component\Literal;

/**
 * NamespaceUtil 
 *   Convert Namespace "\\" to other.
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NamespaceUtil 
{
    /**
     * dirPath 
     * 
     * @param mixed $namespace 
     * @static
     * @access public
     * @return void
     */
    static public function dirPath($namespace)
    {
        return str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
    }

    /**
     * slashPath 
     * 
     * @param mixed $namespace 
     * @static
     * @access public
     * @return void
     */
    static public function slashPath($namespace)
    {
        return str_replace('\\', '/', $namespace);
    }

    /**
     * dotPath 
     * 
     * @param mixed $namespace 
     * @static
     * @access public
     * @return void
     */
    static public function dotPath($namespace)
    {
        return str_replace('\\', '.', $namespace);
    }
}

