<?php
namespace Terpsichore\Service\Common;

class GenericOAuth2Service extends   
{
	protected function getAuthenticationProvider()
	{
		return new GenericOAuth2Provider();
	}
}

