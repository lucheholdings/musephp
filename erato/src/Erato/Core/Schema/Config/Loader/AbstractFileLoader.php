<?php
namespace Erato\Core\Schema\Config\Loader;

use Clio\Component\Literal\NamespaceUtil;

/**
 * AbstractFileLoader 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFileLoader 
{
    /**
     * import 
     *   Import resource from absolute filepath 
     * @param mixed $resource 
     * @abstract
     * @access public
     * @return void
     */
    public function import($filepath)
    {
        $resource = $this->doImport($filepath);

        return $this->parse($imported);
    }

    abstract protected function doImport($filepath)

    /**
     * load 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function load($resource)
    {
        // convert class name to filepath 
        $dotPath = NamespaceUtil::dotPath($resource);
        
        return parent::load($filepath);
    }

    /**
     * doLoad 
     * 
     * @param mixed $resource 
     * @access protected
     * @return void
     */
    protected function doLoad($resource)
    {
        $filepath = $this->getLocator()->locate($resource);

        return $this->import($filepath);
    }

    /**
     * parse 
     * 
     * @param mixed $resource 
     * @access protected
     * @return void
     */
    protected function parse($resource)
    {
        if($this->parser) {
            return $this->parser->parse($resource);
        }
        return $resource;
    }
}

