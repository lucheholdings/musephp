<?php
namespace Clio\Component\Util\Cache;

interface CacheProvider
{
	function save($id, $data, $ttl = 0);

	function fetch($id);

	function contains($id);

	function delete($id);

	function flush();
}

