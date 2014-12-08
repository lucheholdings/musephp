<?php
namespace Calliope\Extra\Filter;

class CacheFilter extends Filter 
{
	public function requestFindBy(Condition $condition)
	{
		$manager = $condition->getConnection()->getConnectFrom();
		$metadata = $manager->getSchemaMetadata();

		if($metadata->hasMapping('cache')) {
			$hash = $this->getGenerateHashFromRequest($condition);

			if($cacheProvider->has($hash)) {
				$response = $cacheProvider->get($hash);
				if($uri == $response->getRequestUri()) {
					$condition->terminateRequset($response);
				}
			}
		}
	}

	public function responseFetch(Condition $condition)
	{
		// Create cache for the requested response
		$hash = $this->getGenerateHashFromCondition($condition);

		
	}

	public function responseSave(Condition $condition)
	{
		// clear cache if exists.
		$this->cacheClear();
	}

	protected function generateHashFromCondition($condition)
	{
		$conds = $condition->getFetchConditions();
		return sha1(serialize($conds));
	}
}

