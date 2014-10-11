<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Util;


/**
 * ScopeUtil 
 * 
 * @uses Scope
 * @uses ScopeUtilInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ScopeUtil 
{
	/**
	 * @var string OAuth2 scope delimiter.
	 */
	protected $delimiter = ' ';

	/**
	 * __construct 
	 * 
	 * @param mixed $storage 
	 * @param string $delimiter 
	 * @access public
	 * @return void
	 */
	public function __construct($delimiter = ' ')
	{
		$this->delimiter = $delimiter;
	}

	/**
	 * fromArray 
	 * 
	 * @param array $scopes 
	 * @access public
	 * @return void
	 */
	public function fromArray(array $scopes)
	{
		if(is_null($scopes)) {
			return null;
		} else if(is_string($scopes)) {
			return $scopes;
		} else if(is_array($scopes)) {
			return implode($this->delimiter, array_unique($scopes));
		}

		throw new \InvalidArgumentException('Invalid Type of Scopes');
	}

	/**
	 * toArray 
	 * 
	 * @param mixed $scope 
	 * @access public
	 * @return void
	 */
	public function toArray($scope)
	{
		if(null === $scope) {
			return null;
		} else if(is_string($scope)) {
			return explode($this->delimiter, $scope);
		}

		throw new \Exception('Invalid Type of scopes');
	}

	/**
	 * getDelimiter 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDelimiter()
	{
		return $this->delimiter;
	}
}

