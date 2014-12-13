<?php
namespace Clio\Component\Util\Query;

/**
 * Comparison 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
final class Operators
{
	const COMPARISON_NE       = 'ne';
	const COMPARISON_EQ       = 'eq';
	const COMPARISON_GT       = 'gt';
	const COMPARISON_GE       = 'ge';
	const COMPARISON_LT       = 'lt';
	const COMPARISON_LE       = 'le';
	const COMPARISON_IN       = 'in';
	const COMPARISON_MATCH    = 'match';
	const COMPARISON_IS_NULL  = 'null';
	const COMPARISON_IS_ANY   = 'any';

	const LOGIC_OR            = 'or';
	const LOGIC_AND           = 'and';
}

