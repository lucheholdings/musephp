<?php
namespace Terpsichore\Client\Auth\OAuth;

use Terpsichore\Client\Auth\Provider\AbstractHttpProvider;

/**
 * AbstractOAuthProvider 
 *   Provider with OAuth Authentication Logic 
 * @uses AbstractProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractOAuthProvider extends AbstractHttpProvider 
{
	/**
	 * __construct 
	 * 
	 * @param mixed $tokenUri 
	 * @param array $options 
	 * @param Connection $connection 
	 * @access public
	 * @return void
	 */
	public function __construct($tokenUri, array $options = array(), Connection $connection = null)
	{
		parent::__construct($connection, $options);

		$this->tokenUri = $tokenUri;
	}
}

