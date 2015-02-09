<?php
namespace Clio\Component\IO\Format\Raml;

use Clio\Component\IO\Parser as BaseParser;
use Clio\Component\IO\Builder\ArrayBuilder;

class Parser extends BaseParser 
{
	public function __construct()
	{
		$this->builderFactory = new ArrayBuilderFactory();
	}

	public function parse()
	{
		// 1st parse as yaml
		$data = $this->getYamlParser()->parse();

		$builder = $this->createBuilder();

		// 2nd validate the raml
		$this->validate($data);

		// return as array.
		// If you need to construct tree-construct data or some, then override this parser
		// and use Builder to establish the data container.
		return $builder->getData();
	}

	protected function validate($data)
	{
		foreach($data as $key => $value) {
			if($this->isPath($key)) {
				$this->doValidatePath($key, $value);
			} else if($this->isMethod($key)) {
				$this->doValidateMethod($key, $value);
			} else if($this->isReservedProperty($key)) {
				// reserved
				$this->doValidateReserved($key, $value);
			} else {
				$this->doValidateProperty($key, $value);
			}
		}
	}

	protected function doValidatePath($path, $data, $parentPath = '')
	{
		$currentPath = $parentPath . $path;

		$builder->enterPath($currentPath);

		// validate child element 
		foreach($data as $key => $value) {
			if(0 === strpos('/', $key)) {
				// validate child path
				$this->doValidatePath($key, $value, $currentPath);
			} else if($this->isMethodToken($key)) {
				// Path method
				$this->doValidateMethod($key, $data, $currentPath);
			} else {
				throw new ParseException(sprintf('Unknown item "%s" is specified.', $key));
			}
		}

		$builder->leavePath();
	}

	protected function doValidateQueryParameters($data)
	{
		foreach($data as $key => $value) {
			$this->doValidateQueryParameter($key, $value);
		}
	}

	protected function doValidateQueryParameter($key, $value)
	{
		if(0 === strpos('/', $key)) {
			throw new ParseException('Parameter cannot start with "/"');
		}
		// fixme : any other validation rules for parameter key and value here.
		$builder->addQueryParameteter($key, $value);
	}

	protected function doValidateMethod($method, $data, $path)
	{
		switch($method) {
		case 'get':
		case 'post':
		case 'delete':
		case 'put':
		case 'patch':
		case 'head':
			// method is the leaf of the scopes. thus lock while work on the method.
			$builder->enterScope($method);
			$builder->lockScope();

			foreach($data as $key => $value) {
				switch($key) {
				case 'headers':
					$this->setHeaders($value);
					break;
				default:
					break;
				} 
			}

			$builder->unlockScope();
			$builder->leaveScope();

			break;
		default:
			throw new ParseException(sprintf('Unknown method "%s" is given.', $method));
			break;
		}
	}

	public function doValidateProperty($key, $value)
	{
		$builder->setProperty($key, $value);
	}
}

