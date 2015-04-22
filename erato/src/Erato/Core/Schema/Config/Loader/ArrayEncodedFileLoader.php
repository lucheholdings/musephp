<?php
namespace Erato\Core\Schema\Config\Loader;

use Clio\Component\Pattern\Loader\FileLoader;
use Clio\Component\Pattern\Loader\FileLocator;
use Erato\Core\Schema\Config\Parser\ArrayParser;

/**
 * ArrayEncodedFileLoader 
 * 
 * @uses FileLoader
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class ArrayEncodedFileLoader extends FileLoader
{
    /**
     * parser 
     * 
     * @var mixed
     * @access private
     */
    private $parser;

    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct(FileLocator $locator)
    {
        parent::__construct($locator);

        $this->parser = new ArrayParser();
    }

    /**
     * import 
     * 
     * @param mixed $filepath 
     * @access public
     * @return void
     */
    public function import($filepath) 
    {
        $data = parent::import($filepath);

        return $this->parser->parse($data);
    }
    
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
}
