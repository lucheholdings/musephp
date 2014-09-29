<?php
namespace Melete;

abstract class MultiCodeStandard extends CodeStandard 
{
	private $defaultCodeType;

	private $codeMaps = array();

	public function __construct($name, $defaultCodeType)
	{
		parent::__construct($name);

		$this->defaultCodeType = $defaultCodeType;
	}

	protected function expandCodeType(Content $content)
	{
		$defaultType = $this->getDefaultCodeType();
		$types = array_keys($this->codeMaps);

		foreach($types as $type) {
			$this->codeMaps[$type][$content->get($type)] = $content->get($defaultType);
		}
	}

	public function getContents($codeType = null)
	{
		if(!$codeType || ($codeType == $this->getDefaultCodeType()) ) {
			return parent::getContents();
		}

		return array_map(function($v) {
			return $this->contents[$v];
		}, $this->codeMaps[$codeType]);
	}

	public function getCodes($codeType = null)
	{
		if(!$codeType) {
			$codeType = $this->getDefaultCodeType();
		}
	}

	public function getCodeTypes()
	{
		return array_unique(array_merge(array($this->getDefaultCodeType()), array_keys($this->codeMaps)));
	}

    public function getDefaultCodeType()
    {
        return $this->defaultCodeType;
    }
    
    public function setDefaultCodeType($defaultCodeType)
    {
        $this->defaultCodeType = $defaultCodeType;
        return $this;
    }

	public function addCodeType($type)
	{
		if(!isset($this->codeMaps[$type])) {
			$this->codeMaps[$type] = array();
		}
		return $this;
	}

	public function setByCode($code, $content)
	{
		parent::setByCode($code, $content);

		$this->expandCodeType($content);

		return $this;
	}

	public function getByCode($code, $codeType = null) 
	{
		$defaultType = $this->getDefaultCodeType();

		if(!$codeType || ($codeType == $defaultType)) {
			return parent::getByCode($code);
		}
		return parent::getByCode($this->getCodeMap($codeType, $code));
	}

	public function getCodeMap($type, $code)
	{
		if(!isset($this->codeMaps[$type])) {
			throw new \InvalidArgumentException(sprintf('Invalid code type "%s"', $type));
		}

		return $this->codeMaps[$type][$code];
	}
}

