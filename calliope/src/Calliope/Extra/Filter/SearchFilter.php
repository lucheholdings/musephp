<?php
namespace Calliope\Extra\Filter;

use Calliope\Extra\Filter\Condition;

/**
 * SearchFilter 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SearchFilter extends Filter 
{
	public function requestFindBy(Condition $condition)
	{
		// get owner metadata
		$metadata = $condition->getConnectFrom()->getSchemaMetadata();
		if($metadata->hasMapping('search')) {
			// only if search mapping exists, filter support support 
			

			// terminate the request, and return the new response
			$condition->terminateRequest($searcher->searchBy($criteria, $orderBy, $limit, $offset));
		}
	}

	public function requestFindOneBy(Condition $condition)
	{
		// get owner metadata
		$metadata = $condition->getConnectFrom()->getSchemaMetadata();
		if($metadata->hasMapping('search')) {
			// only if search mapping exists, filter support support 
			

			// terminate the request, and return the new response
			$condition->terminateRequest($searcher->searchOneBy($criteria, $orderBy));
		}
	}
}

