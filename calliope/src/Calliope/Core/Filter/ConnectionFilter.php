<?php
namespace Calliope\Core\Filter;

use Calliope\Core\Filter;

/**
 * ConnectionFilter 
 * 
 * @uses Filter
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ConnectionFilter implements Filter 
{
	/**
	 * {@inheritdoc}
	 */
	public function filterFindBy(Request $request, Response $response)
	{
		$data = $request->get('connection')->findBy(
			$request->get('criteria', array()), 
			$request->get('orderBy', array()),
			$request->get('limit', null),
			$request->get('offset', null)
		);

		$response->set('data', $data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterFindOneBy(Request $request, Response $response)
	{
		$data = $request->get('connection')->findOneBy(
			$request->get('criteria', array()), 
			$request->get('orderBy', array())
		);

		$response->set('data', $data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterFlush(Request $request, Response $response)
	{
		$connection = $request->get('connection');
		if(method_exists($connection, 'flush'))
			$connection->flush();
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterCreate(Request $request, Response $response)
	{
		$data = $request->get('connection')->create($request->get('data'));

		$response->set('data', $data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterUpdate(Request $request, Response $response)
	{
		$data = $request->get('connection')->update($request->get('data'));

		$response->set('data', $data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterDelete(Request $request, Response $response)
	{
		$data = $request->get('connection')->delete($request->get('data'));

		$response->set('data', $data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterReload(Request $request, Response $response)
	{
		$data = $request->get('connection')->reload($request->get('data'));

		$response->set('data', $data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function filterCountBy(Request $request, Response $response)
	{
		$count = $request->get('connection')->countBy($request->get('criteria'));

		$response->set('data', $count);
	}
}

