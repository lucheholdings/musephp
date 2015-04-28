<?php
namespace Clio\Component\Pattern\Loader;

/**
 * PrioritySequentialLoader 
 *    SequentialLoader with Priority loading strategy 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PrioritySequentialLoader extends SequentialLoader 
{
    /**
     * load 
     * 
     * @access public
     * @return void
     */
    public function load($resource, array $options = array())
    {
        $excepts = array();
        foreach($this->getLoaders() as $loader) {
            try {
                return $loader->load($resource, $options);
            } catch(Exception $ex) {
                $excepts[] = $ex;
                continue;
            }
        }

        throw $excepts[0];
        throw new Exception\InvalidResourceException(
                sprintf('Cannot load resource "%s".', $resource), 
                0, 
                (count($excepts) == 1) 
                    ? $excepts[0] 
                    : new \Exception(json_encode(array_map(function($ex) {
                        return $ex->getMessage();
                    }, $excepts))));
    }
}

