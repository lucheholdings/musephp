<?php
namespace Clio\Component\Util\Metadata;

/**
 * Loader 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Loader
{
    /**
     * loadMetadata 
     * 
     * @param mixed $schemaName 
     * @access public
     * @return void
     */
    function loadMetadata($schemaName);
}
