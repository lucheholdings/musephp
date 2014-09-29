<?php

namespace Terpsichore\Bundle\ServiceConnectBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TerpsichoreServiceConnectBundle extends Bundle
{
	public function __construct()
	{
		$this->extension = new DependencyInjection\TerpsichoreServiceConnectExtension();
	}
}
