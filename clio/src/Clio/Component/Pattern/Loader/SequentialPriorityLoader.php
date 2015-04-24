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
            try {
                return $laoder->load($resource, $options);
            } catch(Exception $ex) {
                continue;
            }
        }

        throw new Exception\InvalidResourceException(sprintf('Cannot load resource "%s".', $resource));
    }
}

