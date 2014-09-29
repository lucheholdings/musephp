<?php
namespace Clio\Component\Pce\Metadata\Loader;

/**
 * MappingLoader 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface MappingLoader
{
	function loadClassMapping(ClassMetadata $metadata);
}

