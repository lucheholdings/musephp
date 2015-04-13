<?php
namespace Clio\Extra\Tests\Normalizer;

use Clio\Component\Tool\Normalizer\Tests\NormalizerTestCase;
use Clio\Extra\Normalizer\AccessorNormalizer;

use Clio\Extra\Tests\TestAccessorRegistry;

/**
 * AccessorNormalizerTest 
 * 
 * @uses NormalizerTestCase
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class AccessorNormalizerTest extends NormalizerTestCase 
{
	private $normalizer;

	protected function getNormalizer()
	{
		if(!$this->normalizer) {

            $accessorRegistry = new TestAccessorRegistry();
			$this->normalizer = AccessorNormalizer::createDefault($accessorRegistry);
		}

		return $this->normalizer;
	}
}

