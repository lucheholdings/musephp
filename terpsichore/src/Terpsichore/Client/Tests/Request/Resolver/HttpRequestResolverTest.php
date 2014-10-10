<?php
namespace Terpsichore\Client\Tests\Request\Resolver;

use Terpsichore\Client\Request\ServiceRequest;
use Terpsichore\Client\Request\Resolver\HttpRequestResolver;

class HttpRequestResolverTest extends \PHPUnit_Framework_TestCase 
{
	public function testResolveHeaders()
	{
		$resolver = new HttpRequestResolver();
		$request = $this->createRequest();
		// Test Header
		$headers = $resolver->resolveHeaders($request);
		$this->assertCount(1, $headers);
		$this->assertArrayHasKey('Content-Type', $headers);
		$this->assertEquals('application/json', $headers['Content-Type']);

	}

	public function testResolveBody()
	{
		$resolver = new HttpRequestResolver();
		$request = $this->createRequest();

		// Test Body
		$body = $resolver->resolveBody($request);
		$this->assertEquals('content', $body);

	}

	public function testResolveUri()
	{
		$resolver = new HttpRequestResolver();
		$request = $this->createRequest();
		
		// Test Uri
		$uri = $resolver->resolveUri($request);
		$this->assertEquals('http://test.com', $uri);
	}

	public function testResolveMethod()
	{
		$resolver = new HttpRequestResolver();
		$request = $this->createRequest();

		// Test Method
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('GET', $method);

		// Method post 
		$request->setHeader('method', 'post');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('POST', $method);

		// Method put
		$request->setHeader('method', 'put');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('PUT', $method);

		// Method patch
		$request->setHeader('method', 'patch');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('PATCH', $method);

		// Method delete
		$request->setHeader('method', 'delete');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('DELETE', $method);

		// Method head
		$request->setHeader('method', 'Head');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('HEAD', $method);

		// Method options
		$request->setHeader('method', 'options');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('OPTIONS', $method);

		// Method link
		$request->setHeader('method', 'link');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('LINK', $method);

		// Method link
		$request->setHeader('method', 'unLink');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('UNLINK', $method);

		// Method link
		$request->setHeader('method', 'trace');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('TRACE', $method);

		// Method unknown
		$request->setHeader('method', 'unknown');
		$method = $resolver->resolveMethod($request);
		$this->assertEquals('GET', $method);
	}

	public function testCustomHeader()
	{
		$resolver = new HttpRequestResolver();

		$resolver->addAcceptableHttpHeader('Test');
		$request = new ServiceRequest(
			'content',
			array(
				'uri'  => 'http://test.com',
				'method' => 'get',
				'content-type' => 'application/json',
				'test' => 'Hello World',
			)
		);

		$headers = $resolver->resolveHeaders($request);

		$this->assertCount(2, $headers);
		$this->assertArrayHasKey('Test', $headers);
		$this->assertArrayHasKey('Content-Type', $headers);
		$this->assertEquals('Hello World', $headers['Test']);

		$resolver->removeAcceptableHttpHeader('content-type');
		$headers = $resolver->resolveHeaders($request);
		$this->assertCount(1, $headers);
		$this->assertArrayHasKey('Test', $headers);
		$this->assertArrayNotHasKey('Content-Type', $headers);

	}

	protected function createRequest()
	{
		return new ServiceRequest(
			'content',
			array(
				'uri'  => 'http://test.com',
				'method' => 'get',
				'content-type' => 'application/json'
			)
		);

	}
}

