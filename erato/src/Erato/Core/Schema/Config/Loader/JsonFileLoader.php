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
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->parser = new ArrayParser();
    }

    protected function doLoad($resource)
    {
        return parent::doLoad($resource . '.yml');
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
        return Yaml::import($filepath);
    }
}

