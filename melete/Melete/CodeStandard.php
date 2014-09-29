<?php
namespace Melete;

/**
 * CodeStandard 
 * 
 * @uses Standard
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class CodeStandard extends Standard 
{
    public function getCodes()
    {
        return array_keys($this->contents);
    }
    
	public function contains($code)
	{
		return array_key_exists($code, $this->getCodes());
	}

	public function getByCode($code)
	{
		return $this->contents[$code];
	}

	public function setByCode($code, $content)
	{
		$this->contents[$code] = $content;
		return $this;
	}
}

