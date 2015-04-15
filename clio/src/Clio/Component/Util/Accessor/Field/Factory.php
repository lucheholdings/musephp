<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Metadata;

/**
 * Factory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Factory
{
    /**
     * createFieldAccessor 
     * 
     * @param Metadta\Field $field 
     * @access public
     * @return void
     */
    function createFieldAccessor(Metadata\Field $field);
}

