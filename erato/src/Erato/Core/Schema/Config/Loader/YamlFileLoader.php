<?php
namespace Erato\Core\Schema\Config\Loader;

use Symfony\Component\Yaml\Yaml;

/**
 * YamlFileLoader 
 * 
 * @uses ArrayEncodedFileLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class YamlFileLoader extends ArrayEncodedFileLoader 
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

