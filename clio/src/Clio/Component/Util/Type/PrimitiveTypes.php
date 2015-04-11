<?php
namespace Clio\Component\Util\Type;

/**
 * PrimitiveTypes 
 * 
 * @final
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
final class PrimitiveTypes
{
    // BaseType 
    const BASE_TYPE_SCALAR   = 'scalar';
    // Special types
    const TYPE_MIXED        = 'mixed';
    const TYPE_NULL         = 'null';

    // Actual Types
    const TYPE_CLASS        = 'class';
    const TYPE_INTERFACE    = 'interface';
    // Actual Scalar Types
    const TYPE_INT          = 'int';
    const TYPE_FLOAT        = 'float';
    const TYPE_STRING       = 'string';
    const TYPE_BOOL         = 'bool';
    // Actual Array Type
    const TYPE_ARRAY        = 'array';

    // alias of string
    const TYPE_ALIAS_CHAR         = 'char';
    const TYPE_ALIAS_CHARACTOR    = 'charactor';
    // alias of int
    const TYPE_ALIAS_INTEGER      = 'integer';
    // alias of bool 
    const TYPE_ALIAS_BOOLEAN      = 'boolean';
    // alias of class
    const TYPE_ALIAS_OBJECT       = 'object';
    // alias of float
    const TYPE_ALIAS_DOUBLE       = 'double';
    const TYPE_ALIAS_REAL         = 'real';
}

