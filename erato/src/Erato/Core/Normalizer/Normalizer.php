<?php
namespace Erato\Core\Normalizer;

use Clio\Component\Tool\Normalizer\Strategy;
use Clio\Extra\Normalizer\KeyMapNormalizer;

use Erato\Core\CodingStandard;
use Erato\Core\ArrayTool\PropertyToArrayKeyMapper;

/**
 * Normalizer 
 * 
 * @uses BaseNormalizer
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Normalizer extends KeyMapNormalizer 
{
	protected $codingStandard;

	/**
	 * __construct 
	 * 
	 * @param Strategy $strategy 
	 * @param CodingStandard $codingStandard 
	 * @access public
	 * @return void
	 */
	public function __construct(Strategy $strategy, CodingStandard $codingStandard = null)
	{
		// Use default CodingStandard
		if(!$codingStandard) {
			$codingStandard = new CodingStandard();
		}

		$this->codingStandard = $condingStandard;

		parent::__construct($strategy, new PropertyToArrayKeyMapper($this->codingStandard));
	}

    /**
     * getCodingStandard 
     * 
     * @access public
     * @return void
     */
    public function getCodingStandard()
    {
        return $this->codingStandard;
    }
    
    /**
     * setCodingStandard 
     * 
     * @param CodingStandard $codingStandard 
     * @access public
     * @return void
     */
    public function setCodingStandard(CodingStandard $codingStandard)
    {
        $this->codingStandard = $codingStandard;

		$this->getKeyMapper()->setCodingStandard($this->codingStandard);
        return $this;
    }
}

