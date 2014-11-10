<?php
namespace Clio\Extra\Normalizer\Tests;

use Clio\Component\Tool\Normalizer\Tests\NormalizerTestCase;
use Clio\Extra\Normalizer\AccessorNormalizer;

class AccessorNormalizerTest extends NormalizerTestCase 
{
	private $normalizer;

	protected function getNormalizer()
	{
		if(!$this->normalizer) {
			$this->normalizer = AccessorNormalizer::createDefault();
		}

		return $this->normalizer;
	}
}

