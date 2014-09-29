<?php
namespace Calliope\Framework\WebQuery;

/**
 * LiteralSet 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface LiteralSet
{
    /**
     * operatorNe 
     * 
     * @access public
     * @return void
     */
    function operatorNe();

    /**
     * operatorGt 
     * 
     * @access public
     * @return void
     */
    function operatorGt();

    /**
     * operatorGe 
     * 
     * @access public
     * @return void
     */
    function operatorGe();

    /**
     * operatorLt 
     * 
     * @access public
     * @return void
     */
    function operatorLt();

    /**
     * operatorLe 
     * 
     * @access public
     * @return void
     */
    function operatorLe();

    /**
     * operatorMatch 
     * 
     * @access public
     * @return void
     */
    function operatorMatch();

    /**
     * operatorOr 
     * 
     * @access public
     * @return void
     */
    function operatorOr();

    /**
     * operatorAnd 
     * 
     * @access public
     * @return void
     */
    function operatorAnd();

    /**
     * collectionOpen 
     * 
     * @access public
     * @return void
     */
    function collectionOpen();

    /**
     * collectionClose 
     * 
     * @access public
     * @return void
     */
    function collectionClose();

    /**
     * collectionSeparator 
     * 
     * @access public
     * @return void
     */
    function collectionSeparator();

    /**
     * decorateOperator 
     * 
     * @param mixed $op 
     * @access public
     * @return void
     */
    function decorateOperator($op);

    /**
     * valueNull 
     * 
     * @access public
     * @return void
     */
    function valueNull();

    /**
     * valueAny 
     * 
     * @access public
     * @return void
     */
    function valueAny();

    /**
     * isEscapeLiteral 
     * 
     * @param mixed $char 
     * @access public
     * @return void
     */
    function isEscapeLiteral($char);
}

