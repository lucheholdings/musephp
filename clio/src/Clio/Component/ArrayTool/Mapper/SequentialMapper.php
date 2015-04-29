<?php
namespace Clio\Component\ArrayTool\Mapper;

/**
 * SequentialMapper 
 * 
 * @uses MapperCollection
 * @uses Mapper
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialMapper extends MapperCollection implements Mapper 
{
    /**
     * map 
     * 
     * @param array $values 
     * @final
     * @access public
     * @return void
     */
    final public function map(array $values)
    {
        foreach($this->mappers as $mapper) {
            $values = $mapper->map($values);
        }

        return $values;
    }

    /**
     * inverseMap 
     * 
     * @param array $values 
     * @final
     * @access public
     * @return void
     */
    final public function inverseMap(array $values)
    {
        foreach($this->mappers as $mapper) {
            $values = $mapper->inverseMap($values);
        }
        return $values;
    }
}

