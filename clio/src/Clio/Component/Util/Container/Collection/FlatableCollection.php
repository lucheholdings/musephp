<?php
namespace Clio\Component\Util\Container\Collection;

/**
 * FlatableCollection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FlatableCollection extends Collection
{
	private $glue;

	/**
	 * __construct 
	 * 
	 * @param array $values 
	 * @param string $glue 
	 * @access public
	 * @return void
	 */
	public function __construct(array $values = array(), $glue = '.')
	{
		parent::__construct($values);

		$this->glue = $glue;
	}

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		if(is_array($value)) {
			$flatten = $this->doFlat($value);
			foreach($flatten as $k => $v) {
				parent::set($k, $v);
			}
		} else {
			parent::set($key, $value);
		}
		return $this;
	}

	/**
	 * flat 
	 * 
	 * @access public
	 * @return void
	 */
	public function flat()
	{
		return new FlatableCollection($this->doFlat($this->toArray()), $this->glue);
	}

	/**
	 * inflat 
	 *   Inflat the collection values.
	 *   If prefix is given, then only inflat values with prefixed key.
	 * 
	 * @param mixed $prefix 
	 * @access public
	 * @return void
	 */
	public function inflat($prefix = null)
	{
		$values = $this->toArray();
		return new FlatableCollection($this->doInflat($values, $prefix), $this->glue);
	}

	/**
	 * doFlat 
	 * 
	 * @param array $valeus 
	 * @param mixed $prefix 
	 * @access private
	 * @return void
	 */
	private function doFlat(array $values, $prefix = null)
	{
		$flatten = array();

		foreach($values as $key => $value) {
			if(is_array($value)) {
				$flatten = array_merge($flatten, $this->doFlat($value, $prefix . $key . $this->glue));
			} else {
				$flatten[$prefix . $key] = $value;
			}
		}
		return $flatten;
	}

	/**
	 * doInflat 
	 * 
	 * @param array & $array &values 
	 * @param mixed $prefix 
	 * @access private
	 * @return void
	 */
	private function doInflat(array & $values, $prefix = null)
	{
		$inflatten = array();
		// first sort the values by key with reversed order 
		$keys = array_keys($values);
		sort($keys);

		$prefixLen = 0;
		if($prefix) {
			$prefix = rtrim($prefix, $this->glue) . $this->glue;
			$prefixLen = strlen($prefix);
		}

		foreach($keys as $key) {
			// if key still exists on values
			if(array_key_exists($key, $values)) {
				if(!$prefix || (0 === strpos($key, $prefix))) {
					// 
					$key = substr($key, $prefixLen);
					$ks = explode($this->glue, $key);
					if(count($ks) == 1) {
						$inflatten[$key] = $values[$prefix . $key];
						unset($values[$key]);
					} else {
						$key = array_shift($ks);
						$inflatten[$key] = $this->doInflat($values, $prefix . $key . $this->glue);
					}
				}
			}
		}

		return $inflatten;
	}
    
    /**
     * Get glue.
     *
     * @access public
     * @return glue
     */
    public function getGlue()
    {
        return $this->glue;
    }
    
    /**
     * Set glue.
     *
     * @access public
     * @param glue the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setGlue($glue)
    {
        $this->glue = $glue;
        return $this;
    }
}

