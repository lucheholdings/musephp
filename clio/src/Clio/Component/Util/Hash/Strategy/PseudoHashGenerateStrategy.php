<?php
namespace Clio\Component\Util\Hash\Strategy;

/**
 * PseudoHashGenerateStrategy 
 * 
 * @uses HashGenerateStrategyInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PseudoHashGenerateStrategy implements HashGenerateStrategyInterface
{
	private $defaultByteLen = 8;

	/**
	 * generate 
	 * 
	 * @param int $byteLen 
	 * @access public
	 * @return void
	 */
	public function generate($byteLen = null)
	{
		if(!$byteLen) {
			$byteLen = $this->getDefaultByteLen();
		}

        $bytes = false;
        if (function_exists('openssl_random_pseudo_bytes') && 0 !== stripos(PHP_OS, 'win')) {
            $bytes = openssl_random_pseudo_bytes($byteLen, $strong);

            if (true !== $strong) {
                $bytes = false;
            }
        }

        // let's just hope we got a good seed
        if (false === $bytes) {
			if($byteLen <= 32) {
				$algo = 'sha256';
			} else if($byteLen <= 64) {
				$algo = 'sha512';
			} else {
				throw new \Clio\Component\Exception\Exception('Hash can only be generated to max-length(64byte) without openssl_random_psuedo_bytes.');
			}

			$bytes = hash($algo, uniqid(mt_rand(), true), true);

			$bytes = substr($bytes, 0, $byteLen);
		}
		// Convert binary to base 36 [0-z] number
        return base_convert(bin2hex($bytes), 16, 36);
	}
    
    /**
     * Get defaultByteLen.
     *
     * @access public
     * @return defaultByteLen
     */
    public function getDefaultByteLen()
    {
        return $this->defaultByteLen;
    }
    
    /**
     * Set defaultByteLen.
     *
     * @access public
     * @param defaultByteLen the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDefaultByteLen($defaultByteLen)
    {
        $this->defaultByteLen = $defaultByteLen;
        return $this;
    }
}

