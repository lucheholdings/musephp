<?php
namespace Clio\Extra\Loader;

use Clio\Component\Pattern\Loader;
use Clio\Component\Pattern\Parser\Parser;
use Clio\Component\Format;
use Clio\Component\Format\Json\Json;
use Clio\Bridge\SymfonyComponents\Format\Yaml\Yaml;
use Clio\Component\Exception\UnsupportedException;

/**
 * FormattedFileLoader 
 * 
 * @uses FileLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FormattedFileLoader extends Loader\FileLoader
{
    /**
     * createFormat 
     * 
     * @param mixed $format 
     * @static
     * @access public
     * @return void
     */
    static public function createFormat($format)
    {
        switch((string)$format) {
        case 'json':
            return new Json();
        case 'yaml':
        case 'yml':
            return new Yaml();
        default:
        }

        throw new \InvalidArgumentException('Unsupported format.');
    }

	/**
	 * formats 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $formats;

    /**
     * __construct 
     * 
     * @param Loader\FileLocator $locator 
     * @param array $formats 
     * @access public
     * @return void
     */
	public function __construct(Loader\FileLocator $locator, array $formats = array(), Parser $parser = null)
	{
		parent::__construct($locator, $parser);

		$this->formats = array();
        foreach($formats as $format) {
            $this->addFormat($format);
        }
	}

    /**
     * doImport 
     * 
     * @param mixed $filepath 
     * @access protected
     * @return void
     */
    protected function doImport($filepath)
    {
		$format = $this->resolveFormat($filepath);
		$context = parent::doImport($filepath);

		return $format->parse($context);
    }

	/**
	 * resolveFormat 
	 *   Guess the format from file extension 
	 * 
	 * @param mixed $resource 
	 * @access public
	 * @return bool|Format
	 */
	public function resolveFormat($resource)
	{
		$extension = pathinfo($resource, PATHINFO_EXTENSION);
		// 
		foreach($this->formats as $format) {
			if(($format instanceof Format\FileFormat) && $format->isValidExtension($extension)) {
				return $format;
			}
		}

		return false;
	}

	/**
	 * addFormat 
	 * 
	 * @param Format $format 
	 * @access public
	 * @return void
	 */
	public function addFormat($format)
	{
        if(is_string($format)) {
            $format = self::createFormat($format);
        } else if(!$format instanceof Format\Format) {
            throw new \InvalidArgumentException('Unsupported format.');
        }

        $this->formats[] = $format;
		return $this;
	}

	/**
	 * removeFormat 
	 * 
	 * @param Format $format 
	 * @access public
	 * @return void
	 */
	public function removeFormat(Format\Format $format)
	{
		$this->formats = array_filter($this->formats, function($v){
			return $format !== $v;
		});
	}

	/**
	 * getFormats 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFormats()
	{
		return $this->formats;
	}
}

