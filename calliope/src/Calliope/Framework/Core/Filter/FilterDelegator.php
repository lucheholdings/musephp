<?php
namespace Calliope\Framework\Core\Filter;

interface FilterDelegator
{
	function onPreFlush();

	function onPostFlush();

	function onPreCreate($model);

	function onPostCreate($model);

	function onPreUpdate($model);

	function onPostUpdate($model);
	
	function onPreDelete($model);

	function onPostDelete($model);

	function onPreReload($model);

	function onPostReload($model);

	function onPreFindBy(array $criteria, array $orderBy, $limit, $offset);

	function onPostFindBy($result, array $criteria, array $orderBy, $limit, $offset);

	function onPreFindOneBy(array $criteria, array $orderBy);

	function onPostFindOneBy($result, array $criteria, array $orderBy);

	function onPreCountBy(array $criteria);

	function onPostCountBy($result, array $criteria);

	function onConnect();

	function attachFilter($filter);

	function detachFilter($filter);
}

