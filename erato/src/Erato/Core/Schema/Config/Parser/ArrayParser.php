<?php
namespace Erato\Core\Schema\Config\Parser;

use Erato\Core\Schema\Config\Parser;

/**
 * ArrayParser 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ArrayParser implements Parser 
{
    /**
     * parse 
     * 
     * @access public
     * @return void
     */
    public function parse($contents)
    {
        if(!is_array($contents)) {
            throw new \InvalidArgumentException('Invalid format of contents.');
        }
        
        // 

        return $contents;
    }
}

