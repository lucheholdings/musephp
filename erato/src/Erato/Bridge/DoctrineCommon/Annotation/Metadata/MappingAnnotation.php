<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Metadata;

interface MappingAnnotation 
{
	/**
	 * getTargetMappings 
	 *   Names of target mappings 
	 * @access public
	 * @return array
	 */
	function getTargetMappings();

	/**
	 * getConfigs 
	 *   Configuration Key-Values 
	 * @access public
	 * @return array
	 */
	function getConfigs();
}

