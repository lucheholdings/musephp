<?php
namespace Clio\Component\Metadata;

/**
 * Field 
 *   Field is another type of Metadata.
 *   Field is owned by Schema, and reference coresponding Schema.
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Field extends Metadata
{
    /**
     * getOwnedSchema 
     *   Get Schema which onwed this field 
     * @access public
     * @return void
     */
    function getOwnedSchema();

    /**
     * getTypeSchema 
     *   Get schema which type of this field.
     * @access public
     * @return void
     */
    function getTypeSchema();
}

