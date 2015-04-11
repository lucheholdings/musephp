<?php
namespace Clio\Component\Pattern\Loader;

/**
 * SequentialPriorityLoader 
 *    SequentialLoader with Priority loading strategy 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialPriorityLoader extends SequentialLoader 
{
    /**
     * load 
     * 
     * @access public
     * @return void
     */
    public function load($resource, array $options = array())
    {
        foreach($this->getLoaders() as $loader) {
            if($loader->canLoad($resource, $options)) {
                return $laoder->load($resource, $options);
            }
        }

        throw new UnsupportedException(sprintf('Cannot load resource "%s".', $resource));
    }
}

