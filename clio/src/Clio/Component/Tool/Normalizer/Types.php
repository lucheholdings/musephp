<?php
namespace Clio\Component\Tool\Normalizer;

/**
 * Types 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Types 
{
	// Null
	const TYPE_NULL    = 'null';
	// Primitive types
	const TYPE_INT     = 'int';
	const TYPE_INTEGER = 'integer';
	const TYPE_STRING  = 'string';
	const TYPE_FLOAT   = 'float';
	const TYPE_DOUBLE  = 'double';
	const TYPE_BOOL    = 'bool';
	const TYPE_BOOLEAN = 'boolean';
	const TYPE_CHAR    = 'char';

	// "array" is an alias of "set"
	const TYPE_ARRAY   = 'array';
	const TYPE_SET     = 'set';
	const TYPE_MAP     = 'map';

	const TYPE_IGNORE  = 'ignore';
	const TYPE_MIXED   = 'mixed';
}

