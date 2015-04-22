<?php
namespace Erato\Core\Schema\Config;

use Clio\Component\Pattern\Parser\Parser as BaseParser;

/**
 * Parser 
 *   ParserInterface of Erato Schema Configuration 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Parser extends BaseParser
{
    /**
     * parse 
     *   Parse Resource to Config
     * @param mixed $contents 
     * @access public
     * @return void
     */
    function parse($contents);
}

