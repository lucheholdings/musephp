<?php
namespace Clio\Component\Literal;

/**
 * CaseUtil
 * 
 * @final
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
final class CaseUtil
{
    /**
     * replaceInvalidChars 
     * 
     * @param mixed $word 
     * @static
     * @access protected
     * @return void
     */
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

    /**
     * isSnakeCase 
     * 
     * @param mixed $value 
     * @static
     * @access public
     * @return void
     */
    static public function isSnakeCase($value)
    {
        // Start with lower case and followed by lower case alphanumeric or underbar 
        return preg_match('/[a-z][a-z0-9_]*/', $value);
    }

    /**
     * isCamelCase 
     * 
     * @param mixed $value 
     * @static
     * @access public
     * @return void
     */
    static public function isCamelCase($value)
    {
        // Start with lower case and followed by any alphanumeric
        return preg_match('/[a-z][a-zA-Z0-9]*/', $value);
    }

    /**
     * isPascalCase 
     * 
     * @param mixed $value 
     * @static
     * @access public
     * @return void
     */
    static public function isPascalCase($value)
    {
        // Start with upper case and followed by any alphanumeric
        return preg_match('/[A-Z][a-zA-Z0-9]*/', $value);
    }
}


