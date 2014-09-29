<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Model;

use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\ClientProviderStrategy;

/**
 * ClientProvider 
 * 
 * @uses ClientProviderInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ClientProvider implements ClientProviderStrategy
{
    /**
     * {@inheritdoc}
     */
    public function findClientByPublicId($publicId)
    {
        if (false === $pos = strpos($publicId, '_')) {
            return null;
        }

        $id       = substr($publicId, 0, $pos);
        $randomId = substr($publicId, $pos + 1);

        return $this->findClientBy(array(
            'id'        => $id,
            'randomId'  => $randomId,
        ));
    }
}
