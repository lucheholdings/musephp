<?php
namespace Clio\Extra\Metadata\Config\Loader;

use Clio\Extra\Metadata\Config\Util as ConfigurationUtil;

/**
 * MergeLoader 
 * 
 * @uses ConfigLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MergeLoader implements ConfigLoader 
{
	private $loaders;

	public function __construct($loader)
	{
		$this->loaders = (array)$loader;
	}

	public function load($resource)
	{
		foreach($this->getLoaders() as $loader) {
			if($loader->canLoad($resource)) {
				$loaded[] = $loader->load($resource);
			}
		}

		$this->mergeConfigs($loaded);
	}
    
    public function getLoaders()
    {
        return $this->loaders;
    }
    
    public function setLoaders(array $loaders)
    {
        $this->loaders = $loaders;
        return $this;
    }

	/**
	 * mergeConfigs 
	 * 
	 * @param array $configs 
	 * @access protected
	 * @return void
	 */
	protected function mergeConfigs(array $configs) 
	{
		$merged = array_shift($configs);

		foreach($configs as $config) {
			//
			$merged = ConfigurationUtil::merge($merged, $config);
		}

		return $merged;
	}
}

