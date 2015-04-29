<?php
namespace Clio\Component\ArrayTool\Mapper;

/**
 * RecursiveKeyMapper 
 * 
 * @uses AbstractMapper
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class RecursiveKeyMapper implements Mapper 
{
	private $innerMapper;

    /**
     * __construct 
     * 
     * @param Mapper $innerMapper 
     * @access public
     * @return void
     */
	public function __construct(Mapper $innerMapper)
	{
		$this->innerMapper = $innerMapper;
	}

	/**
	 * {@inheritdoc}
	 */
	public function map(array $values)
	{
		$mapped = $this->getInnerMapper()->map($values);

		foreach($mapped as $key => $value) {
			if(is_array($value)) {
				$mapped[$key] = $this->map($value);
			}
		}

		return $mapped;
	}

	/**
	 * {@inheritdoc}
	 */
	public function inverseMap(array $values)
	{
		$mapped = $this->getInnerMapper()->inverseMap($values);

		foreach($mapped as $key => $value) {
			if(is_array($value)) {
				$mapped[$key] = $this->inverseMap($value);
			}
		}

		return $mapped;
	}
    
    public function getInnerMapper()
    {
        return $this->innerMapper;
    }
    
    public function setInnerMapper($innerMapper)
    {
        $this->innerMapper = $innerMapper;
        return $this;
    }
}


