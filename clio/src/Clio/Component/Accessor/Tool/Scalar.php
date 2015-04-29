<?php
namespace Clio\Component\Accessor\Tool;

/**
 * Scalar 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Scalar 
{
    /**
     * raw 
     * 
     * @var mixed
     * @access public
     */
    public $raw;

    public function __construct($raw)
    {
        $this->raw = $raw;
    }

    /**
     * isNull 
     * 
     * @access public
     * @return void
     */
    public function isNull()
    {
        return is_null($this->raw);
    }
}

