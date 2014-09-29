<?php
namespace Clio\Component\Auth\OAuth2\Util;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ScopeUtil implements ScopeUtilInterface
{
	/**
	 * @var string OAuth2 scope delimiter.
	 */
	protected $delimiter = ' ';

	/**
	 * __construct 
	 * 
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
			return implode($this->delimiter, $scopes);
		}

		throw new \Clio\Component\Exception\InvalidArgumentException('Invalid Type of Scopes');
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

		throw new \Clio\Component\Exception\Exception('Invalid Type of scopes');
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

