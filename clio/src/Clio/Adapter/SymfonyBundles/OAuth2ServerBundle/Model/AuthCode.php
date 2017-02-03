<?php

/*
 * This file is part of the ClioOAuth2ServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

/**
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class AuthCode extends Token implements AuthCodeInterface
{
    /**
     * @var string
     */
    protected $redirectUri;

    /**
     * {@inheritdoc}
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }
}
