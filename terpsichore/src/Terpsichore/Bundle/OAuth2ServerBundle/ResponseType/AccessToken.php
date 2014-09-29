<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\ResponseType;

use OAuth2\ResponseType\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken 
{
    /**
     * Get config.
     *
     * @access public
     * @return config
     */
    public function getConfigs()
    {
        return $this->config;
    }
    
    /**
     * Set config.
     *
     * @access public
     * @param config the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConfigs(array $configs)
    {
        $this->config = $config;
        return $this;
    }

	public function setConfig($key, $value) 
	{
		$this->config[$key] = $value;
	}
}

