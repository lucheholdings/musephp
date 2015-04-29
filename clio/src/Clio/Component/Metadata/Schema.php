<?php
namespace Clio\Component\Metadata;

/**
 * Schema 
 *   Metadata\Schema is a MappingInfomation of Type Component.
 *   More than type component, it has fields, and additional information as Mappings.
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Schema extends Metadata
{
    /**
     * getType 
     * 
     * @access public
     * @return Clio\Component\Type\Type 
     */
    function getType();

    /**
     * getFields 
     * 
     * @access public
     * @return void
     */
    function getFields();

    /**
     * hasField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    function hasField($field);

    /**
     * getField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    function getField($field);

    /**
     * isValidData 
     * 
     * @access public
     * @return void
     */
    function isValidData($data);
}

