<?php
namespace Clio\Component\Util\Format;

class StandardFormat extends BasicFormat implements FileFormat, ContentTypeFormat 
{
	private $extension;

	private $contentType;

	public function __construct($name, $parser, $dumper, $extension, $contentType)
	{
		parent::__construct($name, $parser, $dumper);

		$this->extension = is_array($extension) ? array_values($extension) : array($extension);
		$this->contentType = is_array($contentType) ? array_values($contentType) : array($contentType);
	}

	/**
	 * import 
	 * 
	 * @param mixed $file 
	 * @access public
	 * @return void
	 */
	public function import($file)
	{
		return $this->parse($file);
	}

	/**
	 * getFileExtension 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFileExtension()
	{
		return $this->extension[0];
	}

	/**
	 * getContentType 
	 * 
	 * @access public
	 * @return void
	 */
	public function getContentType()
	{
		return $this->contentType[0];
	}

	/**
	 * validateExtension 
	 * 
	 * @param mixed $extension 
	 * @access public
	 * @return void
	 */
	public function validateExtension($extension)
	{
		return in_array($extension, $this->extension);
	}

	/**
	 * validateContentType 
	 * 
	 * @param mixed $contentType 
	 * @access public
	 * @return void
	 */
	public function validateContentType($contentType)
	{
		return in_array($extension, $this->contentType);
	}
}

