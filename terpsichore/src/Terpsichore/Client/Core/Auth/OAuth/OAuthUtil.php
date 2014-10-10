<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\OAuth;

use Terpsichore\Client\Auth\OAuth\OAuthToken;
use Terpsichore\Client\Auth\OAuth\OAuth1Token;
use Terpsichore\Client\Client\HttpRequest;

class OAuthUtil 
{
	static public function signRequest(HttpRequest $request, OAuthToken $token)
	{
		$reqParams = array(
			'oauth_consumer_key' => $token->getClientId(),
			'oauth_timestamp'    => $token->getTimestamp(),
			'oauth_nonce'        => $token->getNonce(),
			'oauth_version'      => '1.0',
			'oauth_signature_method' => $token->getSignatureMethod(),
			'oauth_token'        => $token->getToken(),
		);

		$url = parse_url($request->getUrl());
		if(isset($url['query'])) {
			parse_str($url['query'], $queryParams);
			$reqParams += $queryParams;
		}

        // Remove default ports
        // Ref: Spec: 9.1.2
        $explicitPort = isset($url['port']) ? $url['port'] : null;
        if (('https' === $url['scheme'] && 443 === $explicitPort) || ('http' === $url['scheme'] && 80 === $explicitPort)) {
            $explicitPort = null;
        }

        // Remove query params from URL
        // Ref: Spec: 9.1.2
        $url = sprintf('%s://%s%s%s', $url['scheme'], $url['host'], ($explicitPort ? ':'.$explicitPort : ''), isset($url['path']) ? $url['path'] : '');

        // Parameters are sorted by name, using lexicographical byte value ordering.
        // Ref: Spec: 9.1.1 (1)
        uksort($reqParams, 'strcmp');

        // http_build_query should use RFC3986
        $parts = array(
            // HTTP method name must be uppercase
            // Ref: Spec: 9.1.3 (1)
            strtoupper($request->getMethod()),
            rawurlencode($url),
            rawurlencode(str_replace(array('%7E', '+'), array('~', '%20'), http_build_query($reqParams, '', '&'))),
        );

        $baseString = implode('&', $parts);

		$signatureMethod = $token->getSignatureMethod();
        switch ($signatureMethod) {
            case OAuth1Token::SIGNATURE_METHOD_HMAC:
                $keyParts = array(
                    rawurlencode($token->getClientSecret()),
                    rawurlencode($token->getTokenSecret()),
                );

                $signature = hash_hmac('sha1', $baseString, implode('&', $keyParts), true);
                break;

            case OAuth1Token::SIGNATURE_METHOD_RSA:
                if (!function_exists('openssl_pkey_get_private')) {
                    throw new \RuntimeException('RSA-SHA1 signature method requires the OpenSSL extension.');
                }

                $privateKey = openssl_pkey_get_private(file_get_contents($token->getClientSecret()), $token->getTokenSecret());
                $signature  = false;

                openssl_sign($baseString, $signature, $privateKey);
                openssl_free_key($privateKey);
                break;

            case OAuth1Token::SIGNATURE_METHOD_PLAINTEXT:
                $signature = $baseString;
                break;
            default:
                throw new \RuntimeException(sprintf('Unknown signature method selected %s.', $signatureMethod));
        }

        return base64_encode($signature);
	}
}

