<?php
namespace Erato\Core\Schema\Config\Loader;

use Symfony\Component\Yaml\Yaml;

class YamlFileLoader extends ArrayEncodedFileLoader 
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

