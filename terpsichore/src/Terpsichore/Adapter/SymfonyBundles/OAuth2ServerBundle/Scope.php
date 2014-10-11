<?php
namespace Terpsichore\Adapter\SymfonyBundle\OAuth2ServerBundle;

use OAuth2\Scope;

class Scope extends BaseScope 
{
	public function __construct(ScopeStorage $storage)
	{
		parent::__construct($storage);
	}
}

