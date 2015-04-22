<?php
namespace Clio\Component\Util\Id\Generator\Strategy;

use Clio\Component\Util\Id\Generator\Strategy;

/**
 * UuidGenerateStrategy 
 * 
 * @uses Strategy
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class UuidGenerateStrategy implements Strategy 
{
    const DEFAULT_VERSION  = 4;

    /**
     * version 
     * 
     * @var mixed
     * @access private
     */
    private $version;

    /**
     * __construct 
     * 
     * @param mixed $version 
     * @access public
     * @return void
     */
    public function __construct($version = self::DEFAULT_VERSION)
    {
		// Create UUID
		if(!function_exists('uuid_create')) {
			throw new \RuntimeException('php uuid module is not installed.');
		}

        switch($version) {
        case 1:
        case UUID_TYPE_TIME:
            $this->version = UUID_TYPE_TIME;
            break;
        case 4:
        case UUID_TYPE_RANDOM:
            $this->version = UUID_TYPE_RANDOM;
            break;
        default:
            throw new \InvalidArgumentException(sprintf('Unsupported version "%s" is specified.', $version));
        }
    }

    /**
     * generate 
     * 
     * @access public
     * @return void
     */
    public function generate()
    {
        return uuid_create($this->version);
    }
}
