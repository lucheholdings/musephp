<?php
namespace Clio\Component\Tool\ArrayTool\Mapper;

use Clio\Component\Tool\ArrayTool\Mapper\Mapper;

/**
 * MapperCollection 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MapperCollection 
{
    /**
     * mappers 
     * 
     * @var array
     * @access protected
     */
    protected $mappers = array();

    /**
     * __construct 
     * 
     * @param array $mappers 
     * @access public
     * @return void
     */
    public function __construct(array $mappers = array())
    {
        $this->mappers = array();

        foreach($mappers as $mapper) {
            $this->push($mapper);
        }
    }

    /**
     * unshift 
     * 
     * @param Mapper $mapper 
     * @access public
     * @return void
     */
    public function unshift(Mapper $mapper)
    {
        array_unshift($this->mappers, $mapper);
        return $this;
    }

    /**
     * push 
     * 
     * @param Mapper $mapper 
     * @access public
     * @return void
     */
    public function push(Mapper $mapper)
    {
        array_push($this->mappers, $mapper);
        return $this;
    }

    /**
     * shift 
     * 
     * @access public
     * @return void
     */
    public function shift()
    {
        return array_shift($this->mappers);
    }

    /**
     * pop 
     * 
     * @access public
     * @return void
     */
    public function pop()
    {
        return array_pop($this->mappers);
    }

    /**
     * count 
     * 
     * @access public
     * @return void
     */
    public function count()
    {
        return count($this->mappers);
    }
}

