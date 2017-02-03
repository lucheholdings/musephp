<?php
namespace Clio\Component\Pce\Injection;

/**
 * ObjectInjector 
 *   ObjectInjector injects Injections into Object. 
 *    
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ObjectInjector 
{
	const PRIORITY_DEFAULT   = 0;

	private $types;

	private $injections;

	public function __construct(array $types = array())
	{
		// Default Priorities
		$this->types = array();
		$this->injections = array();
	}

	public function inject($object)
	{
		// fixme
		// resolve duplicated-call over interfaces injections
		$injections = $this->resolveInjections();

		foreach($injections as $injection) {
			$injection->inject($object);
		}

		return $object;

		// 
		ksort($this->injections);

		foreach($this->injections as $priority => $injections) {
			foreach($injections as $injection) {
				$injection->inject($object);
			}
		}

		return $object;
	}

	public function hasInjection($type, ObjectInjection $injection)
	{
		$priority = $this->getTypePriority($type);
		
		return in_array($injection, $this->injections[$priority]);
	}

	public function addInjection($type, ObjectInjection $injection)
	{
		$priority = $this->getTypePriority($type);

		if(!isset($this->injections[$priority])) {
			$this->injections[$priority] = array();
		}

		$this->injections[$priority][] = $injection;

		return $this;
	}


	public function getTypes()
	{
		return array_keys($this->types);
	}

	public function getTypePriorities()
	{
		return $this->types;
	}

	public function setTypePriorities(array $types)
	{
		$this->types = $types;
	}

	public function getTypePriority($type)
	{
		return isset($this->types[$type]) ? $this->types[$type] : self::PRIORITY_DEFAULT;
	}

	public function setTypePriority($type, $priority)
	{
		if(!is_numeric($priority)) {
			throw new \InvalidArgumentException('Priority has to be a numeric.');
		}

		$this->types[$type] = $priority;
	}

	public function hasType($type)
	{
		return array_key_exists($type, $this->types); 
	}

	public function addType($type, $priority = self::PRIORITY_DEFAULT)
	{
		$this->types[$type] = $priority;
		return $this;
	}

	public function removeType($type)
	{
		if(!$this->types[$type]) {
			throw new \InvalidArgumentException(sprintf('Type "%s" is not exists.', $type));
		}

		unset($this->types[$type]);

		return $type;
	}
}

