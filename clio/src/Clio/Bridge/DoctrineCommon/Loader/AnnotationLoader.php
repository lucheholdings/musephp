<?php
namespace Clio\Bridge\DoctrineCommon\Loader;

use Clio\Component\Pattern\Loader;
use Doctrine\Common\Annotations\Reader,
	Doctrine\Common\Annotations\AnnotationReader
;

/**
 * AnnotationLoader 
 * 
 * @uses Loader
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AnnotationLoader implements Loader\Loader 
{
	/**
	 * {@inheritdoc}
	 */
	static public function createLoader()
	{
		return static::create(new AnnotationReader());
	}

	/**
	 * {@inheritdoc}
	 */
	private $reader;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(Reader $reader)
	{
		$this->reader = $reader;
	}

	/**
	 * {@inheritdoc}
	 */
	public function load($resource)
	{
		if($resource instanceof \ReflectionClass) {
			$reflector = $resource;
		} else if(is_string($resource) && class_exists($resource)) {
			$reflector = new \ReflectionClass($resource);
		} else {
			throw new Loader\Exception\InvalidResourceException('Unsupported.');
		}

		$data = $this->doLoad($reflector);

		return $data;
	}

	/**
	 * doLoad 
	 * 
	 * @param \ReflectionClass $reflector 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doLoad(\ReflectionClass $reflector);
    
    public function getReader()
    {
        return $this->reader;
    }
    
    public function setReader(Reader $reader)
    {
        $this->reader = $reader;
        return $this;
    }
}

