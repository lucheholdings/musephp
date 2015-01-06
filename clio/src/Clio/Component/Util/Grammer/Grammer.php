<?php
namespace Clio\Component\Util\Grammer;

/**
 * Grammer 
 * 
 * @final
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
final class Grammer
{
	static protected function replaceInvalidChars($word)
	{
		return preg_replace('/[^\d\w]/', '_', $word);
	}
	/**
	 * camelize 
	 *   snakized or capitalized to camelized 
	 * @param mixed $word 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function camelize($word)
	{
		$word = self::replaceInvalidChars($word);
		// if snakized word, then replace '_' with capitalized next word.
		return rtrim(lcfirst(preg_replace_callback('/_+(\w)/i', function($matches){
			return ucfirst($matches[1]);
		}, $word)), '_');
	}

	/**
	 * snakize 
	 * 
	 * @param mixed $word 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function snakize($word)
	{
		$word = self::replaceInvalidChars($word);
		return preg_replace_callback(
			'/[A-Z]/', 
			function($matches){ return '_' . strtolower($matches[0]); }, 
			preg_replace_callback(
				'/^([A-Z])/', 
				function($matches) { return strtolower($matches[0]); }, 
				$word
			));
	}

	/**
	 * capitalize 
	 * 
	 * @param mixed $word 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function pascalize($word)
	{
		$word = self::replaceInvalidChars($word);
		// if snakized word, then replace '_' with capitalized next word.
		return rtrim(ucfirst(preg_replace_callback('/_+(\w)/i', function($matches){
			return ucfirst($matches[1]);
		}, $word)), '_');
	}
}


