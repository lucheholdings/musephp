<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage;

use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\JwtBearerManagerInterface;
use OAuth2\Storage as OAuth2Storage;
use Terpsichore\Bundle\OAuth2ServerBundle\Util\StorageUtil;

/**
 * JwtBearer 
 * 
 * @uses OAuth2Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class JwtBearer extends StrategicStorage implements OAuth2Storage\JwtBearerInterface
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(JwtBearerManagerStrategy $strategy, StorageUtil $storageUtil = null)
	{
		parent::__construct($strategy, $storageUtil);
	}

	public function setStrategy(StorageStrategy $strategy)
	{
		if(!($strategy instanceof JwtBearerManagerStrategy)) {
			throw new \InvalidArgumentException('Invalid Strategy for JwtBearer');
		}
		return parent::setStrategy($strategy);
	}

	/**
	 * getJwtBearerManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getJwtBearerManager()
	{
		return $this->getStrategy();
	}

    /* OAuth2_Storage_JWTBearerInterface */
    public function getClientKey($clientId, $subject)
    {
		$jwt = null;
		try {
			$jwt = $this->getJwtBearerManager()->findOneBy(array('clientId' => $clientId, 'subject' => $subject));
		} catch(NoResultException $ex) {
			$jwt = null;
		}

		return $jwt->getPublicKey();
    }
}
