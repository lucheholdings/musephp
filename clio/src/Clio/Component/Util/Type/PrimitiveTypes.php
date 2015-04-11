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
	const BASETYPE_SCALAR   = 'scalar';
	const BASETYPE_MIXED    = 'mixed';

    const TYPE_CLASS        = 'class';
    const TYPE_INTERFACE    = 'interface';
	const TYPE_NULL			= 'null';
	const TYPE_MIXED		= 'mixed';
	const TYPE_SCALAR       = 'scalar';

	const TYPE_INTEGER		= 'integer';
	const TYPE_DOUBLE		= 'double';
	const TYPE_FLOAT		= 'float';
	const TYPE_CHAR			= 'char';
	const TYPE_STRING		= 'string';
	const TYPE_BOOLEAN		= 'boolean';
	const TYPE_ARRAY		= 'array';

	const TYPE_REAL         = 'real';
	const TYPE_BINARY       = 'binary';

	const TYPE_ALIAS_INT	= 'int';
	const TYPE_ALIAS_BOOL	= 'bool';
	const TYPE_ALIAS_CHARACTOR    = 'charactor';
	const TYPE_ALIAS_OBJECT       = 'object';
}

