<?php
namespace Clio\Component\Pattern\Loader;

use Clio\Component\Pattern\Parser\Parser;

/**
 * AbstractResourceLoader 
 *   Loader to load from resource.
 *   Resource can be parsed.
 *   Parser can be null, if no need to parse the resource. this is the same as import()
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractResourceLoader implements Loader 
{
    /**
     * parser 
     * 
     * @var mixed
     * @access protected
     */
    protected $parser;

    /**
     * __construct 
     * 
     * @param Parser $parser 
     * @access public
     * @return void
     */
    public function __construct(Parser $parser = null)
    {
        $this->parser = $parser;
    }

    /**
     * load 
     *   Load resource 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function load($resource)
    {
        return $this->doLoad($resource);
    }

    /**
     * doLoad 
     *    Actual Loading strategy with imported resource 
     * 
     * @param mixed $resource 
     * @access protected
     * @return void
     */
    protected function doLoad($resource)
    {
        $contents = $this->import($resource);
        if($this->parser)
            return $this->parser->parse($contents);
        return $contents;
    }

    /**
     * import 
     *    import resource 
     * @access public
     * @return void
     */
    function import($resource);
    
    /**
     * getParser 
     * 
     * @access public
     * @return void
     */
    public function getParser()
    {
        return $this->parser;
    }
    
    /**
     * setParser 
     * 
     * @param Parser $parser 
     * @access public
     * @return void
     */
    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
        return $this;
    }
}

