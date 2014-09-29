<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Model;

use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\TokenManagerStrategy;
/**
 * TokenManager 
 * 
 * @uses TokenManagerStrategy
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class TokenManager implements TokenManagerStrategy
{
    /**
     * createToken 
     * 
     * @access public
     * @return void
     */
    public function createToken()
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * findTokenByToken 
     * 
     * @param mixed $token 
     * @access public
     * @return void
     */
    public function findOneByToken($token)
    {
        return $this->findOneBy(array('token' => $token));
    }
}
