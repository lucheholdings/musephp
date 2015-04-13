<?php
namespace Clio\Component\Util\Accessor;

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
     * createAccessor 
     * 
     * @param Metadatas\Schema $schema 
     * @access public
     * @return void
     */
    function createAccessor(Metadata\Schema $schema);
}

