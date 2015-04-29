<?php
namespace Clio\Component\Metadata\Mapping;

use Clio\Component\Metadata\Metadata;

/**
 * Factory 
 *   Mapping Factory interface 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Factory
{
	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	function createMapping(Metadata $metadata, array $options = array());

	/**
	 * isSupportedMetadata 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	function isSupportedMetadata(Metadata $metadata);

	/**
	 * getInjector 
	 *   Get Injector to inject dependencies into Mapping.
	 *   Ex)
	 *     AccessorMapping required AccessorFactory to create Accessor
	 * @access public
	 * @return void
	 */
	function getInjector();

	/**
	 * setOptions 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function setOptions(array $options);
}

