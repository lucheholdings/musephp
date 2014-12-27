<?php
namespace Calliope\Extra\Filter;

class SoftDeleteFilter extends AbstractFilter 
{
	public function filterDelete(Request $request, Response $response)
	{
		$connection = $request->get('connection');

		$connection->update($request->get('data'));
	}
}

