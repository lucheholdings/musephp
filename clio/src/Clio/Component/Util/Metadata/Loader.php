<?php
namespace Clio\Component\Util\Metadata;

use Clio\Component\Pattern\Loader\Loader as BaseLoader;
/**
 * Loader 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Loader extends BaseLoader
{
    /**
     * load
     * 
     * @param mixed $schemaName 
     * @access public
     * @return void
     */
    function load($schemaName);
}
