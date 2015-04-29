<?php
namespace Clio\Component\Normalizer;

use Clio\Component\Type\Type as BaseType;
/**
 * Type 
 *   NormalizerType 
 * @uses ProxyType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Type extends BaseType 
{
    /**
     * hasField 
     *   Check type has subfield or not 
     * @param mixed $field 
     * @access public
     * @return bool
     */
    function hasField($field);

    /**
     * getFieldType 
     *   Get type of subfield. 
     * @param mixed $field 
     * @access public
     * @return void
     */
    function getFieldType($field);

    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    function getOptions();

    /**
     * hasOption 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function hasOption($key);

    /**
     * getOption 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    function getOption($key);

    /**
     * setOption 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
    function setOption($key, $value);

}

