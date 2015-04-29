<?php
namespace Calliope\Core;

use Clio\Component\Metadata\Schema as BaseSchema;

/**
 * Schema 
 *   Calliope Schema Interface. 
 * 
 * @uses BaseSchema
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Schema extends BaseSchema 
{
    /**
     * getManager 
     *   Get Usecase manager of this schema. 
     * 
     * @access public
     * @return void
     */
    function getManager();
}

