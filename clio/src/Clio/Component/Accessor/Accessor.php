<?php
namespace Clio\Component\Accessor;

/**
 * Accessor 
 *   Accessor to Access specified schema
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Accessor
{
    /**
     *  Get, IsXxx, HasXxx.. 
     *  Any kinnda "READ" access is TYPE_GET
     */
	const ACCESS_TYPE_GET = 1;
    /**
     *  Set, Unset, Delete, Add, Update, Clear... 
     *  Any kinnda "WRITE" access is TYPE_SET
     */
	const ACCESS_TYPE_SET = 2;
}

