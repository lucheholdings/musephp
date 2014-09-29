<?php

/*
 * This file is part of the ClioOAuth2ServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Clio\Component\Auth\OAuth2\Util;

class TokenUtil 
{
    static public function generateRandomToken()
    {
        $bytes = false;
        if (function_exists('openssl_random_pseudo_bytes') && 0 !== stripos(PHP_OS, 'win')) {
            $bytes = openssl_random_pseudo_bytes(32, $strong);

            if (true !== $strong) {
                $bytes = false;
            }
        }

        // let's just hope we got a good seed
        if (false === $bytes) {
            $bytes = hash('sha256', uniqid(mt_rand(), true), true);
        }
		// Convert binary to base 36 [0-z] number
        return base_convert(bin2hex($bytes), 16, 36);
    }
}
