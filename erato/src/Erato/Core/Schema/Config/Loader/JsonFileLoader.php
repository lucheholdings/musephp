<?php
namespace Erato\Core\Schema\Config\Loader;

/**
 * JsonFileLoader 
 * 
 * @uses ArrayEncodedFileLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class JsonFileLoader extends ArrayEncodedFileLoader 
{
    /**
     * doLoad 
     * 
     * @param mixed $resource 
     * @access protected
     * @return void
     */
    protected function doLoad($resource)
    {
        return parent::doLoad($resource . '.json');
    }

    /**
     * doImport 
     * 
     * @param mixed $filepath 
     * @access protected
     * @return void
     */
    protected function doImport($filepath)
    {
        return json_decode(parent::doImport($filepath));
    }
}

